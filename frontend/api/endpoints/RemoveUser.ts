import {ApiMethods, BaseApiRequest} from "~/api/web";

export type Response = undefined

export default class RemoveUser extends BaseApiRequest<Request, Response> {
    method = ApiMethods.DELETE

    public endpoint = '/api/users/'
}