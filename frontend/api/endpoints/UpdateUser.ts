import {ApiMethods, BaseApiRequest} from "~/api/web";
import type {User} from "~/types/Common";

export type Request = User
export type Response = undefined

export default class UpdateUser extends BaseApiRequest<Request, Response> {
    method = ApiMethods.PUT

    public endpoint = '/api/users/'
}