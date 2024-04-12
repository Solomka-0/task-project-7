<template>
  <div class=users-module>
    <div class="users">
      <div v-if="formState" class="users__modal-wrapper">
        <div class="users__modal">
          <div class="users__modal-header">
            <div class="users__modal-esc">
              <img src="/ui/icons/close.svg" alt="Закрыть форму" @click="formState = false">
            </div>
          </div>
          <form class="users__modal-content">
            <f-input name="name" v-model="form.name" label-text="Имя пользователя" data-maska="A" :data-maska-eager="false" data-tokens="A:[A-Za-zА-Яа-я0-9]:multiple" required/>
            <f-input name="email" v-model="form.email" placeholder="your-mail@yandex.ru" label-text="электронная почта" type="email" required/>
            <f-input name="phone" v-model="form.phone" placeholder="+7 (900) 900 90-90" type="phone" label-text="номер телефона" required data-maska="+# (###) ### ##-##" data-maska-eager/>
            <f-input name="sex" v-model="form.sex" type="select" :select-options="[{value: Sex.male, caption: 'Мужчина'}, {value: Sex.female, caption: 'Женщина'}]" label-text="пол" required/>
            <f-input name="birthday" v-model="form.birthday" type="date" label-text="дата рождения" required/>
            <div v-if="formAction == FormAction.CREATE" class="btn btn_primary" @click="submitCreate">
              Создать
            </div>
            <div v-else-if="formAction == FormAction.EDIT" class="btn btn_primary" @click="submitEdit">
              Сохранить
            </div>
          </form>
        </div>
      </div>
      <div class="users__item-create" @click="onCreate">
        + Добавить
      </div>
      <div v-for="user in data.users" @click="onEdit(user)" class="users__item">
        <div class="users__item-remove" @click.stop="onDelete(user)">✕</div>
        <div class="flex gap-1">
          <div class="users__name">{{ user.name }}</div>
          <div class="users__sex">{{ user.sex == 'male' ? 'Мужчина' : 'Женщина' }}</div>
        </div>
        <div class="px-2 leading-5 text-stone-700">
          <div class="users__email">{{ user.email }}</div>
          <div class="users__phone">{{ user.phone }}</div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup lang='ts'>
import {useDefaultState} from './composables/useDefault'
import type {User} from "~/types/Common";
import RemoveUser from "~/api/endpoints/RemoveUser";
import FInput from "~/src/components/FInput/FInput.vue";
import {Sex} from "~/types/Common";
import type {For} from "@babel/types";
import StoreUser from "~/api/endpoints/StoreUser";
import UpdateUser from "~/api/endpoints/UpdateUser";

const ctx = useDefaultState()

const {data}: { data: Ref<{ users: User[] }> } = await useAsyncData('users', () => ctx.value)

// i18
const i18nPrefix = "modules.Users"
const nuxtApp = useNuxtApp()
const $i = nuxtApp.$i(i18nPrefix)
const $toDateSymfony = nuxtApp.$toDateSymfony
const $fromDateSymfony = nuxtApp.$fromDateSymfony

type FormFields = {
  id?: number,
  name?: string,
  email?: string,
  phone?: string,
  sex?: string,
  birthday?: string,
}

enum FormAction {
  CREATE,
  EDIT
}

const form = reactive<FormFields>({
  id: undefined,
  name: undefined,
  email: undefined,
  phone: undefined,
  sex: undefined,
  birthday: undefined,
})
const formState = ref(false)
const formAction: Ref<FormAction | undefined> = ref(undefined)

// Очистка формы
function formCleanup() {
  form.name = undefined
  form.email = undefined
  form.phone = undefined
  form.sex = undefined
  form.birthday = undefined
}

function onCreate() {
  formCleanup()
  formAction.value = FormAction.CREATE
  formState.value = true
}

async function submitCreate() {
  console.log('submitCreate')
  try {
    const response = await new StoreUser().request(undefined,
        form
    )
    data.value.users.push(response!.value)
  } catch (e) {
    throw new Error("Проверьте поля")
  }
}

function onEdit(user: User) {
  formState.value = true
  formAction.value = FormAction.EDIT
  form.id = user.id
  form.name = user.name
  form.email = user.email
  form.phone = user.phone
  form.sex = user.sex
  form.birthday = $fromDateSymfony(user.birthday)
}

async function submitEdit() {
  console.log('submitEdit')

  try {
    const response = await new UpdateUser().request(form.id,
        form
    )
    let index = data.value.users.findIndex((user) => user.id == form.id)
    data.value.users[index] = response!.value
  } catch (e) {
    throw new Error("Проверьте поля")
  }
}

function onDelete(user: User) {
  console.log('delete', user.id, data.value.users)
  new RemoveUser().request(user.id).then((response) => {
    data.value.users = data.value.users.filter((item) => item.id !== user.id)
  })
}

</script>

<style lang="scss">
@import "./style.scss";
</style>