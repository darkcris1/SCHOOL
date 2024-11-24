import uuid
from django.db import models
from django_extensions.db.models import TimeStampedModel
from django.db import models
from django.contrib.auth import get_user_model


User = get_user_model()


class Card(models.Model):
    TODO = 'todo'
    IN_PROGRESS = 'wip'
    DONE = 'done'

    STATUSES = [
        (TODO, 'To Do'),
        (IN_PROGRESS, 'In Progress'),
        (DONE, 'Done'),
    ]

    title = models.CharField(max_length=100)
    description = models.TextField()

    status = models.CharField(max_length=10, choices=STATUSES, default=TODO)
    assignee = models.ForeignKey(User, on_delete=models.CASCADE, related_name='assigned_cards')
    creator = models.ForeignKey(User, on_delete=models.CASCADE, related_name='created_cards')
    position = models.PositiveIntegerField(default=0)

    updated_at = models.DateTimeField(auto_now=True)
    created_at = models.DateTimeField(auto_now_add=True)

    class Meta:
        ordering = ['-updated_at']  # This ensures that cards are ordered by position by default

    def __str__(self):
        return self.title