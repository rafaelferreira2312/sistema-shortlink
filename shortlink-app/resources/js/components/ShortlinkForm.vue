<template>
  <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
    <form @submit.prevent="createShortlink">
      <div class="mb-4">
        <label class="block text-gray-700 text-sm font-bold mb-2" for="originalUrl">URL Original:</label>
        <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" v-model="originalUrl" type="text" id="originalUrl" required>
      </div>
      <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">Encurtar</button>
    </form>

    <div v-if="error" class="text-red-500 mt-4">{{ error }}</div>

    <ul v-if="shortlinks.length > 0" class="mt-4">
      <li v-for="shortlink in shortlinks" :key="shortlink.id" class="mb-2">
        <p class="text-gray-700">Original: {{ shortlink.original_url }}</p>
        <p class="text-blue-500">Curto: <a :href="shortlink.short_url" target="_blank">{{ shortlink.short_url }}</a></p>
      </li>
    </ul>
  </div>
</template>

  
  <script>
export default {
  data() {
    return {
      originalUrl: '',
      error: '',
      shortlinks: [],
    };
  },
  methods: {
    async createShortlink() {
      try {
        const response = await axios.post('/api/shortlinks', { original_url: this.originalUrl });
        this.shortlinks.unshift(response.data);
        this.originalUrl = '';
        this.error = '';
      } catch (error) {
        if (error.response) {
          this.error = error.response.data.message;
        } else {
          this.error = 'Erro ao encurtar a URL. Certifique-se de que a URL é válida.';
        }
      }

    },
    async loadShortlinks() {
      try {
        const response = await axios.get('/api/shortlinks');
        this.shortlinks = response.data;
      } catch (error) {
        console.error('Erro ao carregar os shortlinks:', error);
      }
    },
  },
  mounted() {
    // Carregue os shortlinks existentes ao iniciar o componente
    this.loadShortlinks();
  },
  watch: {
    $route(to, from) {
      // Recarregue os shortlinks se a rota mudar
      this.loadShortlinks();
    },
  },
};
</script>

  
  <style scoped>
  /* Estilize conforme necessário */
  .form-container {
    max-width: 400px;
    margin: auto;
  }
  
  .error {
    color: red;
  }
  </style>
  