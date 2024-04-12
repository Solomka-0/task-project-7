import {ApiMethods, BaseApiRequest} from "~/api/web";
import type {User} from "~/types/Common";

export type Request = {
    startFrom?: string
    status?: string
}
export type Response = User[]

export default class GetUsers extends BaseApiRequest<Request, Response> {
    method = ApiMethods.GET

    public endpoint = '/api/users'
}