window.addEventListener('DOMContentLoaded', (event) => {
  async function fetchTest() {
    const response = await window.axios.get('test-ajax');
    console.log(response.data);
  }
  fetchTest();
})