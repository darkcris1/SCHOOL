import { CommonModule } from '@angular/common';
import { Component, OnInit } from '@angular/core';
import { NgbCollapseModule } from '@ng-bootstrap/ng-bootstrap';
import { AuthService } from '../../commons/services/auth.service';
import { Router, RouterModule } from '@angular/router';

@Component({
  selector: 'app-navbar',
  standalone: true,
  imports: [CommonModule, NgbCollapseModule, RouterModule],
  templateUrl: './navbar.component.html',
  styleUrl: './navbar.component.scss'
})
export class NavbarComponent implements OnInit {
  isAuthenticated: boolean = false;
  isCollapsed = true; // Collapse the navbar by default

  constructor(private authService: AuthService, private router: Router) {}

  ngOnInit(): void {
    this.isAuthenticated = this.authService.isAuthenticated;
    
    // Optionally subscribe to the auth status in case it changes during runtime
    this.authService.isAuthenticated$.subscribe((status) => {
      this.isAuthenticated = status;
    });
  }

  logout() {
    this.authService.logout();
    this.router.navigate(['/login']); // Redirect to login page after logout
  }
}
