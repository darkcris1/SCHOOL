import { Injectable } from '@angular/core';
import Swal, { SweetAlertOptions } from 'sweetalert2';

@Injectable({
  providedIn: 'root'
})
export class ToastService {

  constructor() { }

  fire(options?: SweetAlertOptions){
    return Swal.fire({
      icon: "success",
      title: "Signed in successfully",
      toast: true,
      position: "top-end",
      showConfirmButton: false,
      timer: 3000,
      timerProgressBar: true,
      ...options
    });
  }

  error(options?: SweetAlertOptions){
    return this.fire({
      icon: 'error',
      ...options
    })
  }

  success(options?: SweetAlertOptions){
    return this.fire({
      ...options
    })
  }
}
