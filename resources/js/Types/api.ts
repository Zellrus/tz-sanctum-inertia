export interface ApiResponse<T> {
    data: T
}

export interface Pagination<T> {
    data: T[]
    links: Links
    meta: Meta
}

export interface SimplePagination<T>{
    data: T[]
    links: Links
    meta: SimpleMeta
}

export interface Meta {
    current_page: number
    from: number
    last_page: number
    links: Link[]
    path: string
    per_page: number
    to: number
    total: number
}

export interface Link {
    url?: string
    label: string
    page?: number
    active: boolean
}

export interface Links {
    first: string
    last?: string
    prev?: string
    next: string
}

export interface SimpleMeta {
    current_page: number;
    current_page_url: string;
    from: number;
    path: string;
    per_page: string;
    to: number;
}


