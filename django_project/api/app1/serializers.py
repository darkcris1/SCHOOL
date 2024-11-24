from rest_framework import serializers
from django.contrib.auth import get_user_model
from django.contrib.auth import authenticate
from .models import Card

User = get_user_model()

class UserSerializer(serializers.ModelSerializer):
    class Meta:
        model = User
        fields = ['id', 'username', 'email']

    def to_representation(self, instance):
        data = super().to_representation(instance)
        data['photo'] = f"https://eu.ui-avatars.com/api/?name={instance.username}&size=250&background=0D8ABC&color=ffffff"

        return data


class RegisterSerializer(serializers.ModelSerializer):
    password = serializers.CharField(write_only=True, min_length=8)
    confirm_password = serializers.CharField(write_only=True, min_length=8)

    class Meta:
        model = User
        fields = ['username', 'email', 'password', 'confirm_password']

    def validate(self, data):
        if data['password'] != data['confirm_password']:
            raise serializers.ValidationError({"password": "Passwords do not match."})
        return data

    def create(self, validated_data):
        validated_data.pop('confirm_password')  # Remove confirm_password before saving
        user = User.objects.create_user(
            username=validated_data['username'],
            email=validated_data['email'],
            password=validated_data['password']
        )
        return user




class LoginSerializer(serializers.Serializer):
    username = serializers.CharField()
    password = serializers.CharField(write_only=True)

    def validate(self, data):
        user = authenticate(username=data['username'], password=data['password'])
        if not user:
            raise serializers.ValidationError({"detail": "Invalid credentials"})
        return user





# Define serializer for Card
class CardSerializer(serializers.ModelSerializer):
    assignee = serializers.PrimaryKeyRelatedField(queryset=User.objects.all(), required=False)

    class Meta:
        model = Card
        fields = ['id', 'title', 'description', 'creator', 'status', 'assignee', 'position', 'updated_at']
        read_only_fields = ['creator']


    def to_representation(self, instance):
        data = super().to_representation(instance)

        data['assignee'] = UserSerializer(instance.assignee, context=self.context).data
        data['creator'] = UserSerializer(instance.creator, context=self.context).data

        return data


