export enum Sex {
    male = "male",
    female = "female"
}

export type User = {
    id?: number,
    email: string,
    name: string,
    sex?: Sex,
    birthday: string,
    phone: string,
    created_at: string,
    updated_at: string,
}