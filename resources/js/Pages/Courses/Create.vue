  <script setup>
import { ref } from 'vue';
import { useForm } from  '@inertiajs/vue3';
import AppLayout from '@/Layouts/AppLayout.vue';

import { computed, useSlots } from 'vue';


defineEmits(['submitted']);

const hasActions = computed(() => !! useSlots().actions);
  
  // Form state
  const form = useForm({  
    title: null,
    description: null,
    episodes: [  
      { title: null, description: null, video_url: null }
    ]
  });
  
  // Methods
  const submit = () => {
    form.post('/courses');
  };
  
  const add = () => {
    form.episodes.push({ title: null, description: null, video_url: null });
  };
  
  const remove = () => {
    if (form.episodes.length > 1) {
      form.episodes.pop();
    }
  };
  
  const computedClass = (index) => {
    return index > 0 ? 'mt-10' : '';
  };
  </script>
  
<template>
    <AppLayout title="Créer des formations">
      <template #header>
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
          Créer des formations
        </h2>
      </template>
  
      <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
       
          <form @submit.prevent="submit" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
            <div class="mb-4">
              <label for="title" class="block text-sm text-gray-700 font-bold mb-2">Titre de la formation</label>
              <input
                id="title"
                class="rounded shadow appearance-none w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                v-model="form.title"
              />
              <div class="text-red-600 mt-2" v-if="form.errors.title">{{ form.errors.title }}</div>
            </div>
  
            <div class="mb-4">
              <label for="description" class="block text-sm text-gray-700 font-bold mb-2">Description</label>
              <textarea
                id="description"
                class="rounded shadow appearance-none w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                v-model="form.description"
              ></textarea>
              <div class="text-red-600 mt-2" v-if="form.errors.description">{{ form.errors.description }}</div>
            </div>
  
            <h3 class="text-2xl text-pink-800 my-4">Episodes de la formation</h3>
  
            <div class="text-red-600 mb-4" v-if="form.errors.episodes">
              {{ form.errors.episodes }}
            </div>
  
            <div v-for="(episode, index) in form.episodes" :key="index">
              <label
                :for="'episode-title-' + index"
                class="block text-sm text-gray-700 font-bold my-2"
                :class="computedClass(index)"
              >
                Titre de l'épisode {{ index + 1 }}
              </label>
              <input
                :id="'episode-title-' + index"
                class="rounded shadow appearance-none w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                v-model="episode.title"
              />
              <div class="text-red-600 mt-2" v-if="form.errors[`episodes.${index}.title`]">
                {{ form.errors[`episodes.${index}.title`] }}
              </div>
  
              <label :for="'episode-description-' + index" class="block text-sm text-gray-700 font-bold my-2">
                Description de l'épisode {{ index + 1 }}
              </label>
              <input
                :id="'episode-description-' + index"
                class="rounded shadow appearance-none w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                v-model="episode.description"
              />
              <div class="text-red-600 mt-2" v-if="form.errors[`episodes.${index}.description`]">
                {{ form.errors[`episodes.${index}.description`] }}
              </div>
  
              <label :for="'episode-video_url-' + index" class="block text-sm text-gray-700 font-bold my-2">
                Lien vidéo de l'épisode {{ index + 1 }}
              </label>
              <input
                :id="'episode-video_url-' + index"
                class="rounded shadow appearance-none w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                v-model="episode.video_url"
              />
              <div class="text-red-600 mt-2" v-if="form.errors[`episodes.${index}.video_url`]">
                {{ form.errors[`episodes.${index}.video_url`] }}
              </div>
            </div>
  
            <button class="bg-green-500 hover:bg-green-700 text-white font-bold m-4 py-2 px-4 rounded" v-if="form.episodes.length < 15" @click.prevent="add">
              +
            </button>
            <button class="bg-red-500 hover:bg-red-700 text-white font-bold m-3 py-2 px-4 rounded" v-if="form.episodes.length > 1" @click.prevent="remove">
                🗑️
            </button>
            <button type="submit" class="block rounded bg-indigo-800 py-2 px-3 hover:bg-indigo-600 text-white">Enregistrer ma formation</button>
          </form>
        </div>
      </div>
    </AppLayout>
  </template>
