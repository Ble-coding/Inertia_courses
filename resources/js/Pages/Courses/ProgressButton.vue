<script setup>
import { defineProps, ref, onMounted, watch } from 'vue';
import axios from 'axios';

// Définissez les props en utilisant defineProps
const props = defineProps(['episodeId', 'watchedEpisodes']);
const emit = defineEmits(['toggle-progress']);

// Déclarez les références et les variables ici
const watchedEp = ref(props.watchedEpisodes);
const isWatched = ref(false);

// Déclarez les méthodes ici
const toggleProgress = () => {
  axios.post('/toggleProgress', {
    episodeId: props.episodeId,
  })
  .then(response => {
    if (response.status === 200) {
      isWatched.value = !isWatched.value;
      emit('toggle-progress', response.data);
    }
  })
  .catch(error => console.log(error));
};

const isWatchedEpisode = () => {
  return watchedEp.value.find(episode => episode.id === props.episodeId) ? true : false;
};

// Utilisez onMounted pour les effets au moment du montage
onMounted(() => {
  isWatched.value = isWatchedEpisode();
});

// Mettre à jour isWatched lorsque watchedEpisodes change
watch(() => props.watchedEpisodes, (newVal) => {
  watchedEp.value = newVal;
  isWatched.value = isWatchedEpisode();
});
</script>
<template>
    <div>
      <button class="bg-green-500 px-2 py-2 rounded text-white" @click="toggleProgress">
        {{ isWatched ? 'Terminé' : 'Terminé ?'}}
      </button>
    </div>
  </template>
  
 
  