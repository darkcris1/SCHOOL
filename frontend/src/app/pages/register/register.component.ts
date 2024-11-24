import { CommonModule } from '@angular/common';
import { Component } from '@angular/core';
import { FormBuilder, FormGroup, ReactiveFormsModule, Validators } from '@angular/forms';
import { AuthService } from '../../commons/services/auth.service';
import { Router, RouterModule } from '@angular/router';
import { ToastService } from '../../commons/services/toast.service';

@Component({
  selector: 'app-register',
  standalone: true,
  imports: [CommonModule, ReactiveFormsModule, RouterModule],
  templateUrl: './register.component.html',
  styleUrl: './register.component.scss'
})
export class RegisterComponent {
  registerForm: FormGroup;
  registerError: string = ''; // General error message
  fieldErrors: { [key: string]: string[] } = {}; // Store field-specific error messages

  constructor(
    private fb: FormBuilder,
    private authService: AuthService,
    private $toast: ToastService,
    private router: Router
  ) {
    // Initialize the form with validation
    this.registerForm = this.fb.group({
      username: ['', [Validators.required]],
      email: ['', [Validators.required, Validators.email]],
      password: ['', [Validators.required, Validators.minLength(6)]],
      confirm_password: ['', [Validators.required]],
    }, {
      // Custom validator to check that password and confirmPassword match
      validators: this.passwordMatchValidator
    });
  }

  // Custom validator for matching password and confirmPassword
  passwordMatchValidator(group: FormGroup): { [key: string]: boolean } | null {
    const password = group.get('password')?.value;
    const confirmPassword = group.get('confirm_password')?.value;
    return password === confirmPassword ? null : { 'passwordMismatch': true };
  }

  // Submit the form
  onSubmit(): void {
    if (this.registerForm.invalid) {
      return;
    }

    // Call the AuthService to register the user
    this.authService.register(this.registerForm.value).subscribe(
      (response) => {
        // On successful registration, navigate to login page
        this.router.navigate(['/login']);

        this.$toast.success({
          title: 'Registration Successful',
          text: 'You have successfully registered. Please login to continue.'
        })
      },
      (error) => {
        // Handle errors returned from the backend
        if (error?.error) {
          this.registerError = ''; // Clear any general error message
          this.fieldErrors = {}; // Clear previous field errors

          // Check if there are field-specific errors
          if (error.error.username) {
            this.fieldErrors['username'] = error.error.username;
          }
          if (error.error.email) {
            this.fieldErrors['email'] = error.error.email;
          }
          if (error.error.password) {
            this.fieldErrors['password'] = error.error.password;
          }
          if (error.error.confirm_password) {
            this.fieldErrors['confirm_password'] = error.error.confirm_password;
          }
          // If there's a general error message
          if (error.error.detail) {
            this.registerError = error.error.detail;
          }
        } else {
          this.registerError = 'An unexpected error occurred. Please try again.';
        }
      }
    );
  }
}
