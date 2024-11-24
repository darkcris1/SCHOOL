import { environment } from "../../environments/environment";



export const apiUrl = `${environment.apiUrl}/api`;
export const API_LOGIN = `${apiUrl}/auth/login/`;
export const API_REGISTER = `${apiUrl}/auth/register/`;
export const API_KANBAN_STATUSES = `${apiUrl}/kanban/statuses/`;
export const API_KANBAN_CARDS = `${apiUrl}/kanban/cards/`;
export const API_KANBAN_USERS = `${apiUrl}/kanban/users/`;