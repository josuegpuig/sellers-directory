<template>
  <div class="section section-signup page-header" :style="signupImage">
    <div class="container">
      <div class="alert alert-danger" v-if="message">
        <div class="container">
          <button
            type="button"
            aria-hidden="true"
            class="close"
            @click="event => removeNotify(event, 'alert-danger')"
          >
            <md-icon>clear</md-icon>
          </button>
          <div class="alert-icon">
            <md-icon>info_outline</md-icon>
          </div>
          <b>ERROR</b> : {{ message }}
        </div>
      </div>
      <div class="md-layout">
        <div
          class="md-layout-item md-size-33 md-medium-size-40 md-small-size-50 md-xsmall-size-70 mx-auto text-center"
        >
          <login-card header-color="green">
            <h4 slot="title" class="card-title">Iniciar Sesión</h4>
            <p slot="description" class="description">Completa los datos</p>
            <md-field
              class="md-form-group"
              :class="{'md-invalid': !form.email && showErrors}"
              slot="inputs"
            >
              <md-icon>email</md-icon>
              <label>Email...</label>
              <md-input v-model="form.email" type="email"></md-input>
              <span class="md-error">Te falta completar este campo</span>
            </md-field>
            <md-field
              class="md-form-group"
              :class="{'md-invalid': !form.password && showErrors}"
              slot="inputs"
            >
              <md-icon>lock_outline</md-icon>
              <label>Contraseña...</label>
              <md-input v-model="form.password" type="password"></md-input>
              <span class="md-error">Te falta completar este campo</span>
            </md-field>
            <md-button slot="footer" class="md-simple md-success md-lg" @click="handleLogin">Iniciar</md-button>
          </login-card>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import { LoginCard } from "@/components";
import Services from "@/services";
export default {
  props: {
    signup: {
      type: String,
      default: require("@/assets/img/city.jpg")
    }
  },
  components: {
    LoginCard
  },
  name: "login-page",
  bodyClass: "login-page",
  data() {
    return {
      firstname: null,
      form: {
        email: null,
        password: null
      },
      leafShow: false,
      message: null,
      showErrors: false
    };
  },
  methods: {
    async handleLogin() {
      let validations = this.validateInputs();
      if (!validations) {
        return;
      }

      let params = this.form;
      const response = await Services.login(params);

      if (response.status === true) {
        this.$store.commit("setLogin", true);

        return;
      }

      if (response.error === "Bad Credentials") {
        this.message = `El email o la constraseña son incorrectos`;
      }
    },
    validateInputs() {
      this.showErrors = true;

      if (!this.form.email || !this.form.password) {
        return false;
      }

      return true;
    },
    removeNotify(e, notifyClass) {
      var target = e.target;
      while (target.className.indexOf(notifyClass) === -1) {
        target = target.parentNode;
      }
      return target.parentNode.removeChild(target);
    },
  },
  computed: {
    headerStyle() {
      return {
        backgroundImage: `url(${this.image})`
      };
    },
    signupImage() {
      return {
        backgroundImage: `url(${this.signup})`
      };
    },
    messageClass() {
      return {
        "md-invalid": this.showErrors
      };
    }
  }
};
</script>
<style></style>
