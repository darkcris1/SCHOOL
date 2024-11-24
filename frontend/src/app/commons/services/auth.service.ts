import { Injectable } from '@angular/core';
import { HttpClient, HttpHeaders } from '@angular/common/http';
import { BehaviorSubject, Observable } from 'rxjs';
import { map, tap } from 'rxjs/operators';
import { API_LOGIN, API_REGISTER } from '../api.constant';

@Injectable({
  providedIn: 'root'
})
export class AuthService {
  private readonly tokenKey = 'aauaadnth_t19aoken';
  
  // Observable for authentication status
  private isAuthenticatedSubject: BehaviorSubject<boolean>;
  public isAuthenticated$: Observable<boolean>;

  constructor(private http: HttpClient) {
    const token = this.token
    this.isAuthenticatedSubject = new BehaviorSubject<boolean>(!!token);
    this.isAuthenticated$ = this.isAuthenticatedSubject.asObservable();
  }

  get token(){
    return localStorage.getItem(this.tokenKey);
  }

  /**
   * Login and save token
   * @param credentials Object containing username and password
   */
  login(credentials: { username: string; password: string }) {
    return this.http.post<any>(API_LOGIN, credentials).pipe(
      tap((response) => {
        localStorage.setItem(this.tokenKey, response.token);
        this.isAuthenticatedSubject.next(true);
      })
    );
  }

  /**
   * Login and save token
   * @param credentials Object containing username and password
   */
  register(data: any) {
    return this.http.post<any>(API_REGISTER, data);
  }

  /**
   * Check if user is authenticated
   */
  get isAuthenticated(): boolean {
    return !!localStorage.getItem(this.tokenKey);
  }

  /**
   * Logout and clear token
   */
  logout(): void {
    localStorage.removeItem(this.tokenKey);
    this.isAuthenticatedSubject.next(false);
  }
}
