<script setup>
import { defineProps, computed } from 'vue';

const props = defineProps({
  watchedEpisodes: {
    type: Array,
    required: true
  },
  episodes: {
    type: Array,
    required: true
  }
});

const percentage = computed(() => {
  const filteredEp = props.episodes.filter(courseEp => {
    return props.watchedEpisodes.find(watchedEp => {
      return watchedEp.id === courseEp.id;
    });
  });

  return Math.ceil(filteredEp.length / props.episodes.length * 100);
});
</script>

<template>
    <div>
      <div class="bg-gray-200 w-full rounded">
        <div class="bg-green-500 text-white rounded-l text-center transition-width duration-500" :style="{ width: percentage + '%' }">{{ percentage }}%</div>
      </div>
    </div>
</template>
  
