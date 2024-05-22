<script setup>
import { defineProps, ref, onMounted } from 'vue';
import axios from 'axios';
import AppLayout from '@/Layouts/AppLayout.vue';  // Vérifiez que ce chemin est correct
import ProgressBar from '@/Pages/Courses/ProgressBar.vue';
import ProgressButton from '@/Pages/Courses/ProgressButton.vue';

const props = defineProps({
  course: {
    type: Object,
    required: true,
  }
});

const currentKey = ref(0);
const watched = ref([]);
const currentEpisode = ref(props.course.episodes[currentKey.value]);

const handleToggleProgress = (updatedWatchedEpisodes) => {
  watched.value = updatedWatchedEpisodes;
};

const toggleProgress = (episodeId) => {
  axios.post('/toggleProgress', {
    episodeId: episodeId,
  })
  .then(response => {
    if (response.status === 200) {
      watched.value = response.data;
    }
  })
  .catch(error => console.log(error));
};

onMounted(() => {
  watched.value = props.course.watchedEpisodes || [];
});

const switchEpisode = (index) => {
  currentKey.value = index;
  currentEpisode.value = props.course.episodes[index];
};
</script>

<template>
    <AppLayout :title="course.title">
      <template #header>
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
          {{ course.title }}  
        </h2>
      </template>
  
      <div class="max-w-7xl py-6 mx-auto sm:px-6 lg:px-8">
        <div class="text-3xl mb-3">{{ currentEpisode.title }}</div>
        <iframe class="w-full h-screen" :src="currentEpisode.video_url" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
        <div class="text-sm text-gray-500 my-3">{{ currentEpisode.description }}</div>
        
        <div class="py-6">
          <ProgressBar :watched-episodes="watched" :episodes="course.episodes"/>
        </div>
        
        <div class="mt-6">
          <ul>
            <li v-for="(episode, index) in course.episodes" :key="episode.id" class="mt-3 flex justify-between items-center">
              <div>
                Épisode n°{{ index + 1 }} - {{ episode.title }}
              </div>
              <ProgressButton :episode-id="episode.id" :watched-episodes="watched" @toggle-progress="handleToggleProgress" />
            </li>
          </ul>
        </div>
      </div>
    </AppLayout>
  </template>
  
