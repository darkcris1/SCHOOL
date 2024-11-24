import { CommonModule } from '@angular/common';
import { Component, inject, Input } from '@angular/core';
import { FormBuilder, FormGroup, ReactiveFormsModule, Validators } from '@angular/forms';
import { NgbActiveModal } from '@ng-bootstrap/ng-bootstrap';
import { User } from '../../commons/models/cards.model';
import { KanbanService } from '../../commons/services/kanban.service';
import { catchError } from 'rxjs';
import { ToastService } from '../../commons/services/toast.service';

@Component({
  selector: 'app-update-card',
  standalone: true,
  imports: [ReactiveFormsModule, CommonModule],
  templateUrl: './update-card.component.html',
  styleUrl: './update-card.component.scss'
})
export class UpdateCardComponent {

  modal = inject(NgbActiveModal);
  $toast = inject(ToastService);


  @Input() card: any;

  updateForm: FormGroup;

  usersQuery;

  constructor(private fb: FormBuilder, private $kanban: KanbanService) {

    this.usersQuery = this.$kanban.getUsers();
    this.updateForm = this.fb.group({
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

    if (this.card) {
      this.updateForm.patchValue({
        title: this.card.title,
        description: this.card.description,
        status: this.card.status,
        assignee: this.card.assignee?.id,
      });
    }
  }

  save(): void {
    if (this.updateForm.valid) {
      const updatedCard = this.updateForm.value;

      this.$kanban.updateCard(this.card.id, updatedCard)
        .pipe(catchError((err)=>{
          this.$toast.error({
            title: 'Error',
            text: 'Failed to update card'
          })
          return err
        }))
        .subscribe((res)=>{
          this.$toast.success({
            title: 'Success',
            text: 'Card updated successfully' 
          })
        Object.assign(this.card, res);
        this.modal.close(updatedCard); // Pass updated card data back to the parent
      });
    }
  }
}
