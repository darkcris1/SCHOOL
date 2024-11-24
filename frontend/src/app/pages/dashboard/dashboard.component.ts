import { CommonModule } from '@angular/common';
import { Component } from '@angular/core';
import { NgbDropdownModule, NgbModal, NgbPaginationModule } from '@ng-bootstrap/ng-bootstrap';
import { KanbanService } from '../../commons/services/kanban.service';
import { FormControl, FormGroup, ReactiveFormsModule, Validators } from '@angular/forms';
import { injectQuery, injectQueryClient } from '@ngneat/query';
import { UntilDestroy, untilDestroyed } from '@ngneat/until-destroy';
import Swal from 'sweetalert2';
import { UpdateCardComponent } from '../../components/update-card/update-card.component';
import { StatusBadgeComponent } from "../../components/status-badge/status-badge.component";
import { CreateCardComponent } from '../../components/create-card/create-card.component';

@UntilDestroy()
@Component({
  selector: 'app-dashboard',
  standalone: true,
  imports: [NgbPaginationModule, CommonModule, ReactiveFormsModule, NgbDropdownModule, StatusBadgeComponent],
  templateUrl: './dashboard.component.html',
  styleUrl: './dashboard.component.scss'
})
export class DashboardComponent {
  cards: any[] = [];
  paginatedCards: any[] = [];
  currentPage: number = 1;
  pageSize: number = 100;
  #query = injectQuery();
  queryClient = injectQueryClient();

  

  form;
  ticketsQuery;
  constructor(
    private kanbanService: KanbanService,
    private modal: NgbModal
  ) {
    this.form = new FormGroup({
      search: new FormControl(''),
      page: new FormControl(''),
      ordering: new FormControl(''),
    })

    this.ticketsQuery = this.getTodos()
  }

  getTodos() {
    return this.#query({
      queryKey: ['todos'] as const,
      queryFn: () => {
        return this.kanbanService.getCards({
          ...this.form.value,
          page: this.currentPage,
          page_size: 100
        })
      },
    });
  }


  isLoading = false;
  ngOnInit(): void {

    this.form.valueChanges.subscribe((value) => { 
      this.ticketsQuery = this.getTodos()
      this.queryClient.refetchQueries({
        queryKey: ['todos']
      })
    })

    this.ticketsQuery.result$
      .pipe(untilDestroyed(this))
      .subscribe((data) => {
      this.isLoading = data.isLoading
      if (data.data) {
        this.cards = data.data.results
      }
    })
  }


  updatePaginatedCards() {
    const startIndex = (this.currentPage - 1) * this.pageSize;
    const endIndex = startIndex + this.pageSize;
    this.paginatedCards = this.cards.slice(startIndex, endIndex);
  }

  // Detect page change
  onPageChange(page: number) {
    this.currentPage = page;
    this.updatePaginatedCards();
  }


  updateCard(card: any) {
    const ref = this.modal.open(UpdateCardComponent, {
      centered: true
    })
    ref.componentInstance.card = card;
  }

  createCard() {
    const ref = this.modal.open(CreateCardComponent, {
      centered: true
    })
  }

  deleteCard(cardId: number) {
    Swal.fire({
      title: 'Delete card ?',
      text: 'Are you sure you want to delete this card ?',
      icon: 'warning',
      showCancelButton: true,
      confirmButtonText: 'Delete',
    }).then((result) => {
      this.kanbanService.deleteCard(cardId).subscribe((data) => {
        this.queryClient.refetchQueries({
          queryKey: ['todos']
      })
      })
    })

  }
}
