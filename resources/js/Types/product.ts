import {Category} from "./category";

export interface Product {
    id: number;
    name: string;
    description: string;
    price: number;
    category: Category
    created_at: string,
    updated_at: string,
}
