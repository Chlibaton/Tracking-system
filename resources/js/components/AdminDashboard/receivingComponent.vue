<style scoped>
.theme--light.v-data-table {
    background-color: #fff;
    color: rgba(0,0,0,.87);
    margin: 10px;
}
.textpads{
    padding: 5px;
    color: white;
    margin: 5px 10px;
}
.bg-warning{
  color:black !important;
}
.v_img{
  cursor: pointer !important;
}
.file-upload-form, .image-preview {
    font-family: "Helvetica Neue",Helvetica,Arial,sans-serif;
    padding: 20px;
}
img.preview {
    width: 200px;
    background-color: white;
    border: 1px solid #DDD;
    padding: 5px;
}
.image-preview {
    width: 100%;
    max-width: 600px;
    margin: auto;
}


.trans{
  -webkit-animation: NAME-YOUR-ANIMATION 1s infinite;  /* Safari 4+ */
  -moz-animation: NAME-YOUR-ANIMATION 1s infinite;  /* Fx 5+ */
  -o-animation: NAME-YOUR-ANIMATION 1s infinite;  /* Opera 12+ */
  animation: NAME-YOUR-ANIMATION 1s infinite;  /* IE 10+, Fx 29+ */
}

@keyframes NAME-YOUR-ANIMATION {
  0%, 49% {
    background-color: transparent;
    /* border: 3px solid #e50000; */
  }
  50%, 100% {
    background-color: #e50000;
  }
}

</style>


<template>
<div>
      <v-toolbar flat color="white">
        <v-toolbar-title>Receiving Section</v-toolbar-title>
        <v-divider class="mx-4" inset vertical></v-divider>
        <v-text-field v-model="search" append-icon="search" label="Search" single-line hide-details></v-text-field>
      <v-spacer></v-spacer>
      <!-- ADD JOF MODAL -->
        <v-dialog v-model="dialog" max-width="500px">
          <template v-slot:activator="{ on }">
            <v-btn color="primary" dark class="mb-2" v-on="on">Add JOF Order</v-btn>
          </template>
          <v-form ref="form" v-model="valid" lazy-validation  @submit.prevent>
          <v-card>
            <v-card-title>
              <span class="headline">{{ formTitle }}</span>
            </v-card-title>

            <v-card-text>
              <v-container grid-list-md>
                <v-layout wrap>
                  <v-flex xs12>
                   <v-text-field v-model="editedItem.jofno" label="JOF#" ></v-text-field>
                  </v-flex>
                  <v-flex xs12>
                    <v-text-field v-model="editedItem.customer_name" label="Customer Name" ></v-text-field>
                  </v-flex>
                  <v-flex xs12>
                    <v-text-field v-model="editedItem.kind_of_ring" label="Kind Of Ring"></v-text-field>
                  </v-flex>
                  <v-flex xs6>
                            <v-menu   v-model="menu1" :close-on-content-click="false" full-width min-width="290px" offset-y >
                              <template v-slot:activator="{ on }">
                                <v-text-field clearable prepend-icon="event" readonly label="Date Prepared" v-on="on"  :value="date1"></v-text-field>
                              </template>
                              <v-date-picker v-model="date1">
                              </v-date-picker>
                            </v-menu>
                  </v-flex>
                  <v-flex xs6>
                    <!-- <v-text-field v-model="editedItem.due_date" label="Due Date"></v-text-field> -->
                            <v-menu v-model="menu2"  :close-on-content-click="false" full-width max-width="290" offset-y >
                              <template v-slot:activator="{ on }">
                                <v-text-field clearable prepend-icon="event" readonly label="Due Date" v-on="on"  :value="date2"></v-text-field>
                              </template>
                              <v-date-picker v-model="date2" >
                              </v-date-picker>
                            </v-menu>
                  </v-flex>
                </v-layout>
              </v-container>
            </v-card-text>

            <v-card-actions>
              <v-spacer></v-spacer>
              <v-btn color="blue darken-1" text @click="close">Cancel</v-btn>
              <v-btn color="blue darken-1" text @click="save">Save</v-btn>
            </v-card-actions>
          </v-card>
             </v-form>
        </v-dialog>
      <!--END  ADD JOF MODAL -->
      </v-toolbar>
      <v-data-table :headers="headers" :items="dataItems" :search="search" class="elevation-1" >
           <template v-slot:item.due_date="{ item }" > 
            <v-chip :class="getColor(item.due_date)" > {{ item.due_date }}</v-chip> 
          </template>
        <template v-slot:item.action="{ item }">
          <v-icon small class="mr-2" @click="editItem(item)" > edit </v-icon>
          <v-icon small  @click="deleteItem(item)" > delete </v-icon>
        </template>
         <template v-slot:item.jofaction="{ item }">
            <div class="my-2">
              <v-btn depressed small color="primary" @click="jofActions(item)">MOVE TO MOLD</v-btn>
            </div>
        </template>
  </v-data-table>
  </div>
</template>

<script>
  export default {
    data: () => ({
      dialog: false,
      valid:false,
      search: '',
      show1:false,
      menu1:false,
      menu2:false,
      headers: [
        { text: 'JOF#', value: 'jofno',  },
        { text: 'Customer Name', value: 'customer_name',  },
        { text: 'Kind of Ring', value: 'kind_of_ring',  },
        { text: 'Date Prepared', value: 'date_prepared',  },
        { text: 'Due Date', value: 'due_date',  },
        { text: 'JOF Status', value: 'jof_status', },
        { text: 'Actions', value: 'action', sortable: false },
         { text: 'JOF ACTION', value: 'jofaction', sortable: false },
      ],
      ruleRequired: [
        v => !!v || 'Field is required',
      ],
      dataItems:[],
      addedItems:{},
      editedIndex: -1,
      editedItem: {
      },
      defaultItem: {},
      toBeUpdated:{},
      mask: '################',
      date1:new Date().toISOString().substr(0, 10),
      date2:new Date().toISOString().substr(0, 10),
      // date2:new Date(new Date().getTime()+(120*24*60*60*1000)).toISOString().substr(0, 10),
    }),
    
    computed: {
      formTitle () {
        return this.editedIndex === -1 ? 'Add JOF Order' : 'Edit JOF Order'
      },
    },

    watch: {
      dialog (val) {
        val || this.close()
      },
    },

    async mounted(){
        axios.get('/api/JOFinit/1')
        .then((response)=>{
            this.dataItems = response.data
        })
    },
//methods

    methods: {
      editItem (item,a) {
        if(a==2){
          this.editedIndex = this.paymentItems.indexOf(item)
          if(this.editedIndex == 0){
          this.item_balance = item.product_price
          console.log(this.editedPaymentItems)
          }else{
            this.item_balance = this.paymentItems[this.editedIndex-1].balance
          }
          this.editedPaymentItems = Object.assign({}, item)
          this.trackingAdd = true
        }else{
          this.editedIndex = this.dataItems.indexOf(item)
          this.editedItem = Object.assign({}, item)
          this.dialog = true
        }
       
      },
      deleteItem (item,a) {
        const index = this.dataItems.indexOf(item)
        confirm('Are you sure you want to delete this item?') && axios.delete('/api/JOFdelete/'+item.id).then(()=>this.dataItems.splice(index, 1));
      },
     
      close (a) {
        this.dialog = false
        setTimeout(() => {
          this.editedItem = Object.assign({}, this.defaultItem)
          this.editedIndex = -1
        }, 300)
      },

    async save (a) {
        if(this.$refs.form.validate()){
            // UPDATE/SAVE JOF
              this.editedItem.date_prepared = this.date1
              this.editedItem.due_date = this.date2
              this.editedItem.jof_status ='Receiving Section'

              if (this.editedIndex > -1) {
                this.toBeUpdated = this.dataItems[this.editedIndex]
                axios.put('/api/JOFupdate',this.editedItem)
                 .then(()=>{  
                      axios.get('/api/JOFinit/1')
                        .then((response)=>{
                            this.dataItems = response.data
                        })
                      })
                  .catch(function (error) {
                      console.log(error);
                  })
              } else {
                  console.log(this.editedItem)
                  this.addedItems = this.editedItem
                  axios.post('/api/JOFcreate',this.editedItem)
                    .then(()=>{  
                      axios.get('/api/JOFinit/1')
                        .then((response)=>{
                            this.dataItems = response.data
                        })
                      })
                }
               this.close()
          }
      },
       getColor (a) {
          const duedate = new Date(a),
            datenow =  new Date(new Date().getTime()+(120*24*7*59*1000)).toISOString().substr(0, 10)

        if (new Date(datenow) > duedate) return 'trans'
        else return 'none'
        // else return 'green'
      },

      jofActions(item){
        item.jof_status = 'Mold Section'
         axios.post('/api/JOFupdateStatus/',item)
            .then(()=>{
                axios.post('/api/jofhistory',item)
                  .then((response)=>{
                        axios.get('/api/JOFinit/1')
                        .then((response)=>{
                            this.dataItems = response.data
                        })
                  })
              })
            .catch(error => {
              console.log(error.message);
            })
      },
      ApproveColor(a){
        switch(a){
            case '0':
              return 'gray'
            break;
            case '1':
              return 'green'
            break
        }
      },
       
    },
   
   
    
  }
</script>