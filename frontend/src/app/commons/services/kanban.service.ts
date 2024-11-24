import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { Observable } from 'rxjs';
import { API_KANBAN_CARDS, API_KANBAN_STATUSES, API_KANBAN_USERS } from '../api.constant';
import { Card, Pagination, User } from '../models/cards.model';
import { urlEncode } from '../utils/http.util';
import { injectQuery } from '@ngneat/query';

@Injectable({
  providedIn: 'root'
})
export class KanbanService {
  TODO = 'todo'
  IN_PROGRESS = 'wip'
  DONE = 'done'


  query = injectQuery()

  constructor(private http: HttpClient) {}

  // Fetch the list of cards
  getCards(qs?: any) {
    return this.http.get<Pagination<Card>>(urlEncode([API_KANBAN_CARDS], qs) );
  }
  // Fetch the list of cards
  updateCard(cardId: any, data: any): Observable<any> {
    return this.http.put<any>(urlEncode([API_KANBAN_CARDS, cardId]), data);
  }

  // Fetch the list of cards
  getUsers() {
    return this.query({
      queryFn: ()=> this.http.get<User[]>(urlEncode([API_KANBAN_USERS])),
      queryKey: ['kanban-users']
    }) 
  }

  // Fetch the list of cards
  createCard(data: any): Observable<any> {
    return this.http.post<any>(urlEncode([API_KANBAN_CARDS]), data);
  }

  // Fetch the list of cards
  deleteCard(cardId: any): Observable<any> {
    return this.http.delete<any>(urlEncode([API_KANBAN_CARDS, cardId]));
  }
}
