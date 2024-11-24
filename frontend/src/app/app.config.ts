import { ApplicationConfig, inject, provideZoneChangeDetection } from '@angular/core';
import { provideRouter } from '@angular/router';

import { routes } from './app.routes';
import { HttpEvent, HttpHandlerFn, HttpRequest, provideHttpClient, withInterceptors } from '@angular/common/http';
import { Observable } from 'rxjs';
import { AuthService } from './commons/services/auth.service';


function tokenInterceptor(req: HttpRequest<unknown>, next: HttpHandlerFn): Observable<HttpEvent<unknown>> {
  const $auth = inject(AuthService); // Inject the AuthService.
  const token = $auth.token; // Retrieve the token from AuthService.

  // Clone the request to add the Authorization header if a token exists.
  const modifiedReq = token
    ? req.clone({
        setHeaders: {
          Authorization: `Token ${token}`,
        },
      })
    : req;

  return next(modifiedReq);
  return next(req);
}
export const appConfig: ApplicationConfig = {
  providers: [
    provideZoneChangeDetection({ eventCoalescing: true }), 
    provideRouter(routes),
    provideHttpClient(
      withInterceptors([tokenInterceptor])
    )
  ]
};
