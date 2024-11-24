import { Component, inject, Input } from '@angular/core';
import { KanbanService } from '../../commons/services/kanban.service';

@Component({
  selector: 'status-badge',
  standalone: true,
  imports: [],
  templateUrl: './status-badge.component.html',
  styleUrl: './status-badge.component.scss'
})
export class StatusBadgeComponent {
  @Input() status: string = '';

  $kanban = inject(KanbanService)
}
