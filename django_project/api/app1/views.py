from .paginations import CardPagination
from .models import Card
from rest_framework.viewsets import ModelViewSet, GenericViewSet
from rest_framework.response import Response
from rest_framework import status
from rest_framework.permissions import IsAuthenticated, AllowAny
from rest_framework.authtoken.models import Token
from django.contrib.auth import get_user_model
from .serializers import CardSerializer, RegisterSerializer, LoginSerializer, UserSerializer

User = get_user_model()


class RegisterViewSet(ModelViewSet):
    """
    Handles user registration.
    """
    queryset = User.objects.all()
    serializer_class = RegisterSerializer
    permission_classes = [AllowAny]

    def create(self, request, *args, **kwargs):
        """
        Overrides the create method to handle registration.
        """
        serializer = self.get_serializer(data=request.data)
        if serializer.is_valid():
            serializer.save()
            return Response({"message": "User registered successfully!"}, status=status.HTTP_201_CREATED)
        return Response(serializer.errors, status=status.HTTP_400_BAD_REQUEST)


class LoginViewSet(ModelViewSet):
    """
    Handles user login and token generation.
    """
    queryset = User.objects.none()  # Login does not operate on a user queryset
    serializer_class = LoginSerializer
    permission_classes = [AllowAny]

    def create(self, request, *args, **kwargs):
        """
        Handles login.
        """
        serializer = self.get_serializer(data=request.data)
        if serializer.is_valid():
            user = serializer.validated_data
            token, _ = Token.objects.get_or_create(user=user)
            return Response({"token": token.key}, status=status.HTTP_200_OK)
        return Response(serializer.errors, status=status.HTTP_400_BAD_REQUEST)


class LogoutViewSet(GenericViewSet):
    """
    Handles user logout by deleting the auth token.
    """
    queryset = User.objects.none()  # Logout does not operate on a user queryset
    permission_classes = [IsAuthenticated]

    def create(self, request, *args, **kwargs):
        """
        Handles logout.
        """
        Token.objects.filter(user=request.user).delete()
        return Response({"message": "Logged out successfully!"}, status=status.HTTP_200_OK)


class CardViewSet(ModelViewSet):
    queryset = Card.objects.all()
    serializer_class = CardSerializer
    pagination_class = CardPagination
    lookup_field = 'pk'
    search_fields = ['title', 'description', 'assignee__username']

    def perform_create(self, serializer):
        # Ensure the position is set if it's not provided
        if 'position' not in self.request.data:
            serializer.validated_data['position'] = self.get_new_position(serializer.validated_data['status'])
        serializer.save(creator=self.request.user)

    def get_new_position(self, status):
        # Get the highest position for the current status and add 1
        last_card = Card.objects.filter(status=status).order_by('-position').first()
        return last_card.position + 1 if last_card else 0



class UserViewSet(ModelViewSet):
    serializer_class = UserSerializer
    lookup_field = 'pk'
    search_fields = ['title', 'description', 'assignee__username']

    def get_queryset(self):
        return self.serializer_class.Meta.model.objects.all()

    def list(self, request, *args, **kwargs):
        queryset = self.get_queryset()
        serializer = self.get_serializer(queryset, many=True)
        return Response(serializer.data)

    def current_user(self, request, *args, **kwargs):
        serializer = self.get_serializer(request.user)
        return Response(serializer.data)