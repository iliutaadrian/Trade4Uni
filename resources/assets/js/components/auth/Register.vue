<template>
   <div class="row justify-content-center">
      <div class="col-md-8">
         <form class="text-center border border-light p-5" @submit.prevent="register">

            <p class="h4 mb-4">Register</p>

            <div class="form-row mb-4">
               <div class="col">
                  <input type="text" v-model="form.name" class="form-control" placeholder="First name">
               </div>
            </div>

            <div class="form-row mb-4">
               <div class="col">
                  <input type="email" v-model="form.email" class="form-control" placeholder="E-mail">
               </div>
            </div>

            <div class="form-row mb-4">
               <div class="col">
                  <input type="text" v-model="form.phone" class="form-control" placeholder="Phone number" aria-describedby="defaultRegisterFormPhoneHelpBlock">
               </div>
            </div>

            <div class="form-row mb-4">
               <div class="col">
                  <select name="city" v-model="form.idCity" class="form-control">
                     <option value="0" disabled selected>Select your city</option>
                     <option value="1">UMF Iasi</option>
                  </select>
               </div>
            </div>

            <div class="form-row mb-4">
               <div class="col">
                  <select name="college" v-model="form.idCollege" class="form-control" >
                     <option value="0" disabled selected>Select your college</option>
                     <option value="1">Iasi</option>
                  </select>
               </div>
            </div>

            <div class="form-row mb-4">
               <div class="col">
                  <input type="password" v-model="form.password" class="form-control" placeholder="Password" aria-describedby="defaultRegisterFormPasswordHelpBlock">

               </div>
            </div>

            <div class="form-row mb-4">
               <div class="col">
                  <input type="password" v-model="form.password_confirmation" class="form-control" placeholder="Password confirm" aria-describedby="defaultRegisterFormPasswordHelpBlock">
               </div>
            </div>

            <button class="btn btn-info btn-block my-3" type="submit">Register</button>


            <p>By clicking
               <em>Sign up</em> you agree to our
               <a href="" target="_blank">terms of service</a>
            </p>
         </form>
      </div>
   </div>
</template>

<script>
    export default {
        data() {
            return{
                form: {
                    name: 'Iliuta',
                    email: 'iliuta@test.com',
                    phone: '0715929003',
                    idCity: 0,
                    idCollege: 0,
                    password: '123456',
                    password_confirmation: '123456',
                }
            }
        },
        methods: {
            register () {
               axios.post('/api/auth/register', this.$data.form)
                   .then(response =>{
                       console.log(response);
                   })
                   .catch(err=>{
                       console.log(err);
                   })
            }
        }
    }
</script>
