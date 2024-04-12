<template>
  <div class="solution-page">
    <div class="page-content container">
      <users/>
    </div>
  </div>
</template>

<script setup="ts">
import {defineI18nRoute} from "#i18n";
import Users from "~/src/modules/Users/Users.vue";

// i18
const i18nPrefix = "pages.Solution"
const nuxtApp = useNuxtApp()
const $i = nuxtApp.$i(i18nPrefix)

defineI18nRoute({
  paths: {
    'en': '/solution',
    'de': '/solution',
    'es': '/solution',
    'fr': '/solution',
    'it': '/solution',
    'pt': '/solution',
    'zh': '/solution',
    'ja': '/solution',
    'ko': '/solution',
    'ru': '/solution',
    'hi': '/solution',
    'pl': '/solution',
    'cs': '/solution',
  }
})

</script>

<style>
@import "./style.scss";
</style>