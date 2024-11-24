export interface Pagination<T> {
    count: number
    next: any
    previous: any
    results: T[]
}

export interface Card {
    id: number
    title: string
    description: string
    creator: User
    status: string
    assignee: User
    position: number
    updated_at: string
}

export interface User {
    id: number
    username: string
    email: string
    photo: string
}