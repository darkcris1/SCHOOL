import { CommonModule } from '@angular/common';
import { Component, inject, Input } from '@angular/core';
import { FormBuilder, FormGroup, ReactiveFormsModule, Validators } from '@angular/forms';
import { NgbActiveModal } from '@ng-bootstrap/ng-bootstrap';
import { User } from '../../commons/models/cards.model';
import { KanbanService } from '../../commons/services/kanban.service';
import { catchError } from 'rxjs';
import { ToastService } from '../../commons/services/toast.service';
import { injectQueryClient } from '@ngneat/query';

@Component({
  selector: 'app-create-card',
  standalone: true,
  imports: [ReactiveFormsModule, CommonModule],
  templateUrl: './create-card.component.html',
  styleUrl: './create-card.component.scss'
})
export class CreateCardComponent {

  modal = inject(NgbActiveModal);
  $toast = inject(ToastService);
  queryClient = injectQueryClient()


  createForm: FormGroup;

  usersQuery;

  constructor(private fb: FormBuilder, private $kanban: KanbanService) {

    this.usersQuery = this.$kanban.getUsers();
    this.createForm = this.fb.group({
      title: [null, Validators.required],
      description: [null, Validators.required],
      status: [null, Validators.required],
      assignee: [null, Validators.required],
    });

  }

  users: User[] = []

  ngOnInit(): void {

    this.usersQuery.result$.subscribe((resp) => {
      if (resp.data) {
        this.users = resp.data;
      }
    })
  }

  save(): void {
    if (this.createForm.valid) {
      const data = this.createForm.value;

      this.$kanban.createCard(data)
        .pipe(catchError((err)=>{
          this.$toast.error({
            title: 'Error',
            text: 'Failed to create the card'
          })
          return err
        }))
        .subscribe((res)=>{
          this.$toast.success({
            title: 'Success',
            text: 'Card created successfully' 
          })
        this.queryClient.refetchQueries({queryKey: ['todos']})
        this.modal.close(data); // Pass updated card data back to the parent
      });
    }
  }
}
