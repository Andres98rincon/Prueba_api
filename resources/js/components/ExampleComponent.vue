<template>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card">
          <div class="card-header">Premios</div>

          <div class="card-body">
            Filtrar por Nombre
            <form>
              <div class="input-group">
                <input
                  placeholder="Buscar por nombre"
                  type="text"
                  v-model="filter"
                  class="form-control"
                  id="inputGroupFile04"
                  aria-describedby="inputGroupFileAddon04"
                  aria-label="Upload"
                />
                <button
                  @click="listar()"
                  value="Buscar"
                  class="btn btn-success"
                  type="button"
                  id="inputGroupFileAddon04"
                >
                  Button
                </button>
              </div>
            </form>
            <br /><br />

            <ul>
              <li v-for="premio in premios" :key="premio.id">
                <a
                  data-bs-toggle="modal"
                  :data-bs-target="`#crearganador${premio.id}`"
                  href="#"
                >
                  {{ premio.award }}
                </a>
                <!-- Modal -->
                <div
                  class="modal fade"
                  :id="`crearganador${premio.id}`"
                  tabindex="-1"
                  aria-labelledby="exampleModalLabel"
                  aria-hidden="true"
                >
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">
                          Agregar ganador {{ premio.award }}
                        </h5>
                        <button
                          type="button"
                          class="btn-close"
                          data-bs-dismiss="modal"
                          aria-label="Close"
                        ></button>
                      </div>
                      <div class="modal-body">
                        <div v-if="premio.winner" class="alert alert-warning" role="alert">
                         El premio ya ha sido Entregado
                        </div>
                        <label for="name">Nombre</label>
                        <input
                          placeholder="Digite el nombre"
                          type="text"
                          name="name"
                          id="name"
                          class="form-control"
                          :disabled="premio.winner"
                          v-model="winners.name"
                        />

                        <label for="name">Apellido</label>
                        <input
                          placeholder="Digite el apellido"
                          type="text"
                          name="lastname"
                          id="lastname"
                          :disabled="premio.winner"
                          class="form-control"
                          v-model="winners.lastname"
                        />

                        <label for="phone">Telefono</label>
                        <input
                          placeholder="Digite el telefono"
                          type="text"
                          name="phone"
                          id="phone"
                          :disabled="premio.winner"
                          class="form-control"
                          v-model="winners.phone"
                        />

                        <label for="address">Direccion</label>
                        <input
                          placeholder="Digite el direccion"
                          type="text"
                          name="address"
                          id="address"
                          class="form-control"
                          :disabled="premio.winner"
                          v-model="winners.address"
                        />

                        <label for="email">Correo</label>
                        <input
                          placeholder="Digite el correo"
                          type="text"
                          name="email"
                          id="email"
                          :disabled="premio.winner"
                          class="form-control"
                          v-model="winners.email"
                        />
                      </div>
                      <div class="modal-footer">
                        <button
                          type="button"
                          class="btn btn-secondary"
                          data-bs-dismiss="modal"
                        >
                          Cerrar
                        </button>
                        <button
                          @click="crear(premio.id)"
                          type="button"
                          class="btn btn-primary"
                          :disabled="premio.winner"
                        >
                          Registrar Premio
                        </button>
                      </div>
                    </div>
                  </div>
                </div>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
// import modal from './modal.vue'
export default {
  //   components:{
  //       modal
  //   },
  data() {
    return {
      filter: null,
      premios: null,
      host: "http://127.0.0.1:8000/api",
      winners: {
        name: "",
        lastname: "",
        phone: "",
        address: "",
        email: "",
        awards_id: "",
      },
    };
  },
  mounted() {
    this.listar();
  },
  methods: {
    listar() {
      let params = { filter: this.filter };
      axios.get(`${this.host}/awards`, { params: params }).then((response) => {
        this.premios = response.data.data;
      });
    },

    crear(premio_id) {
      this.winners.awards_id = premio_id;
      if (
        this.winners.name != "" &&
        this.winners.lastname != "" &&
        this.winners.phone != "" &&
        this.winners.email != ""
      ) {
        axios
          .post(`${this.host}/winners`, this.winners)
          .then((response) => {
            this.listar();
            alert("Agregado correctamente");
          })
          .catch((e) => {
            alert("Este premio ya ha sido seleccionado");
          });
      } else {
        alert("completa los campos");
      }
    },
  },
};
</script>
