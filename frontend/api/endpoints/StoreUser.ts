import {ApiMethods, BaseApiRequest} from "~/api/web";
import type {User} from "~/types/Common";

export type Request = User
export type Response = User

export default class StoreUser extends BaseApiRequest<Request, Response> {
    method = ApiMethods.POST

    public endpoint = '/api/users/'
}