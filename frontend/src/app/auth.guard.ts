import { Injectable } from '@angular/core';
import { CanActivate, Router } from '@angular/router';
import { AuthService } from './commons/services/auth.service';

@Injectable({
  providedIn: 'root',
})
export class AuthGuard {
  constructor(private authService: AuthService, private router: Router) {}

  /**
   * Function-based guard to check if the user is authenticated
   */
  canActivate(): boolean {
    if (this.authService.isAuthenticated) {
      return true;  // If the user is authenticated, allow access
    } else {
      this.router.navigate(['/login']);  // Redirect to login if not authenticated
      return false;
    }
  }
}



@Injectable({
  providedIn: 'root',
})
export class AlreadyLoginGuard implements CanActivate {
  constructor(private authService: AuthService, private router: Router) {}

  /**
   * Prevent access to login and register if the user is already authenticated
   */
  canActivate(): boolean {
    if (this.authService.isAuthenticated) {
      // Redirect to the dashboard if already logged in
      this.router.navigate(['/dashboard']);
      return false; // Prevent access to the route
    }
    return true; // Allow access if not authenticated
  }
}