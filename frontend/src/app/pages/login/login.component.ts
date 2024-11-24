import { Component } from '@angular/core';
import { FormBuilder, FormGroup, ReactiveFormsModule, Validators } from '@angular/forms';
import { AuthService } from '../../commons/services/auth.service';
import { CommonModule } from '@angular/common';
import { Router, RouterModule } from '@angular/router';

@Component({
  selector: 'app-login',
  templateUrl: './login.component.html',
  styleUrls: ['./login.component.scss'],
  standalone: true,
  imports: [CommonModule, ReactiveFormsModule, RouterModule],
})
export class LoginComponent {
  loginForm: FormGroup;
  loginError: string = ''; // General error message
  fieldErrors: { [key: string]: string[] } = {}; // Store field-specific error messages

  constructor(
    private fb: FormBuilder,
    private authService: AuthService,
    private router: Router
  ) {
    // Initialize the form with validation
    this.loginForm = this.fb.group({
      username: ['', [Validators.required]],
      password: ['', [Validators.required]],
    });
  }

  // Submit the form
  onSubmit(): void {
    if (this.loginForm.invalid) {
      return;
    }

    const { username, password } = this.loginForm.value;

    // Call the AuthService to log the user in
    this.authService.login({ username, password }).subscribe(
      (response) => {
        // On successful login, navigate to a different page (like home)
        this.router.navigate(['/dashboard']);
      },
      (error) => {
        // Handle errors returned from the backend
        if (error?.error) {
          this.loginError = ''; // Clear any general error message
          this.fieldErrors = {}; // Clear previous field errors

          // Check if there are field-specific errors
          if (error.error.username) {
            this.fieldErrors['username'] = error.error.username;
          }
          if (error.error.password) {
            this.fieldErrors['password'] = error.error.password;
          }
          // If there's a general error message
          if (error.error.detail) {
            this.loginError = error.error.detail;
          }
        } else {
          this.loginError = 'An unexpected error occurred. Please try again.';
        }
      }
    );
  }
}
