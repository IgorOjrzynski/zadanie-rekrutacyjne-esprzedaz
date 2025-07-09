<template>
  <div class="container mx-auto p-4">
    <h1 class="text-2xl font-bold mb-4">Lista zwierzaków</h1>

    <!-- Form dodawania / edycji -->
    <form @submit.prevent="onSubmit" class="mb-6 space-y-2">
      <input v-model="form.name" type="text" placeholder="Nazwa" class="border p-2 w-full" required />
      <input v-model="form.status" type="text" placeholder="Status" class="border p-2 w-full" />
      <input v-model="photoUrlInput" type="text" placeholder="URL zdjęcia" class="border p-2 w-full" />
      <button type="button" @click="addPhotoUrl" class="bg-blue-500 text-white px-2 py-1">Dodaj URL</button>

      <div class="flex space-x-2">
        <button type="submit" class="bg-green-600 text-white px-4 py-2">{{ form.id ? 'Aktualizuj' : 'Dodaj' }}</button>
        <button v-if="form.id" type="button" @click="resetForm" class="bg-gray-500 text-white px-4 py-2">Anuluj</button>
      </div>
    </form>

    <!-- Lista -->
    <table class="min-w-full border">
      <thead>
        <tr>
          <th class="border px-2">ID</th>
          <th class="border px-2">Nazwa</th>
          <th class="border px-2">Status</th>
          <th class="border px-2">Akcje</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="pet in pets" :key="pet.id">
          <td class="border px-2">{{ pet.id }}</td>
          <td class="border px-2">{{ pet.name }}</td>
          <td class="border px-2">{{ pet.status }}</td>
          <td class="border px-2 space-x-2">
            <button @click="editPet(pet)" class="text-blue-600">Edytuj</button>
            <button @click="deletePet(pet.id)" class="text-red-600">Usuń</button>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script setup>
import { reactive, ref } from 'vue';
import axios from 'axios';

const props = defineProps({
  pets: { type: Array, default: () => [] },
});

const pets = reactive([...props.pets]);

const form = reactive({ id: null, name: '', status: '', photo_urls: [] });
const photoUrlInput = ref('');

function resetForm() {
  form.id = null;
  form.name = '';
  form.status = '';
  form.photo_urls = [];
  photoUrlInput.value = '';
}

function addPhotoUrl() {
  if (photoUrlInput.value) {
    form.photo_urls.push(photoUrlInput.value);
    photoUrlInput.value = '';
  }
}

async function onSubmit() {
  try {
    if (form.id) {
      await axios.put(`/pets/${form.id}`, form);
      const idx = pets.findIndex((p) => p.id === form.id);
      if (idx !== -1) pets[idx] = { ...form };
    } else {
      const { data } = await axios.post('/pets', form);
      if (data.id) {
        pets.push({ id: data.id, ...form });
      }
    }
    resetForm();
  } catch (e) {
    alert('Błąd zapisu');
  }
}

async function deletePet(id) {
  if (!confirm('Na pewno usunąć?')) return;
  try {
    await axios.delete(`/pets/${id}`);
    const idx = pets.findIndex((p) => p.id === id);
    if (idx !== -1) pets.splice(idx, 1);
  } catch (e) {
    alert('Błąd usuwania');
  }
}

function editPet(pet) {
  form.id = pet.id;
  form.name = pet.name;
  form.status = pet.status;
  form.photo_urls = [...(pet.photo_urls || [])];
}
</script>

<style scoped>

</style> 