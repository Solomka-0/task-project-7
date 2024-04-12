import GetUsers from "~/api/endpoints/GetUsers";

export const useDefaultState = () => useState('users', async () => ({
    users: await (new GetUsers()).request(),
}))