from django.urls import include, path
from .views import RegisterViewSet, LoginViewSet, LogoutViewSet, CardViewSet, UserViewSet

urlpatterns = [
    path('auth/register/', RegisterViewSet.as_view({
        'post': 'create'
    }), name='register'),
    path('auth/login/', LoginViewSet.as_view({
        'post': 'create'
    }), name='login'),
    path('auth/logout/', LogoutViewSet.as_view({
        'post': 'create'
    }), name='logout'),
]

urlpatterns += [
    path('kanban/cards/', CardViewSet.as_view({
        'post': 'create',
        'get': 'list',
    }), name='kanban-statuses-create'),
    path('kanban/cards/<int:pk>/', CardViewSet.as_view({
        'put': 'update',
        'delete': 'destroy',
        'get': 'retrieve',
    }), name='kanban-statuses-detail'),
    path('kanban/users/', UserViewSet.as_view({
        'get': 'list',
    }), name='kanban-statuses-detail'),
    path('users/current/', UserViewSet.as_view({
        'get': 'current_user',
    }), name='kanban-statuses-detail'),
]
