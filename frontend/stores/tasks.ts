import {defineStore} from "pinia"
import type {User} from "~/types/Common";

export const useTasksStore = defineStore("tasks", {
    state: (): {
        _lastSelectedTask: User | undefined
    } => ({
        _lastSelectedTask: undefined,
    }),
    actions: {
        selectTask(task: User) {
            this._lastSelectedTask = task
        },
        clearSelected() {
            this._lastSelectedTask = undefined
        },
    },
    getters: {
        lastSelectedTask: (state) => state._lastSelectedTask,
    }
})