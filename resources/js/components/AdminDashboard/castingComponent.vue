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
.transgreen{
  -webkit-animation: GREEN-ANIMATION 1s infinite;  /* Safari 4+ */
  -moz-animation: GREEN-ANIMATION 1s infinite;  /* Fx 5+ */
  -o-animation: GREEN-ANIMATION 1s infinite;  /* Opera 12+ */
  animation: GREEN-ANIMATION 1s infinite;  /* IE 10+, Fx 29+ */
}

@keyframes GREEN-ANIMATION {
  0%, 49% {
    background-color: transparent;
    /* border: 3px solid #e50000; */
  }
  50%, 100% {
    background-color: #3e9430;
  }
}
.remarks{
  color:white;
}


</style>


<template>
<div>
      <v-toolbar flat color="white">
        <v-toolbar-title>Casting Section</v-toolbar-title>
        <v-divider class="mx-4" inset vertical></v-divider>
        <v-text-field v-model="search" append-icon="search" label="Search" single-line hide-details></v-text-field>
      <v-spacer></v-spacer>

          <!-- ADD JOF MODAL -->
        <v-dialog v-model="dialog" max-width="500px">
          <v-form ref="form" v-model="valid" lazy-validation  @submit.prevent>
          <v-card>
            <v-card-title>
              <span class="headline">{{ formTitle }}</span>
            </v-card-title>

            <v-card-text>
              <v-container grid-list-md>
                <v-layout wrap>
                  <v-flex xs12>
                      <v-select  v-model="editedStatus" :items="Status" label="SELECT JOF STATUS" outlined></v-select>
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
            <v-chip :class="getColor(item)" > {{ item.due_date }}</v-chip> 
          </template>
             <template v-slot:item.remarks="{ item }">
            <div class="my-2">
               <v-chip v-if='item.remarks==1' class="bg-info remarks" > Recast Ring</v-chip> 
            </div>
        </template>
         <template v-slot:item.jofaction="{ item }">
            <div class="my-2">
              <v-btn depressed small color="primary" @click="jofActions(item)">MOVE TO STONE</v-btn>
               <v-btn depressed small color="error" @click="editItem(item)">RETURN JOF</v-btn>
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
      headers: [
        { text: 'JOF#', value: 'jofno',  },
        { text: 'Distributor Name', value: 'distributor_name',  },
        { text: 'Customer Name', value: 'customer_name',  },
        { text: 'Kind of Ring', value: 'kind_of_ring',  },
        { text: 'Date Prepared', value: 'date_prepared',  },
        { text: 'Due Date', value: 'due_date',  },
        { text: 'JOF Status', value: 'jof_status', },
         { text: 'Remarks', value: 'remarks', },
         { text: 'JOF ACTION', value: 'jofaction', sortable: false },
      ],
      // Status:['Mold Section','Plastic Section','Wax Section'],
      Status:['Mold Section'],
      dataItems:[],
      editedItem:{},
      editedStatus:'',
      defaultItem:{},
      editedIndex: -1,
    }),
    
    computed: {
      formTitle () {
        return this.editedIndex === -1 ? ' JOF Order' : 'Return JOF Order'
      },
    },
    watch: {
      dialog (val) {
        val || this.close()
      },
    },

    async mounted(){
        axios.get('/JOFinit/5')
        .then((response)=>{
            this.dataItems = response.data
        })
    },
//methods

    methods: {
        getColor (item) {      
          const duedate = new Date(item.due_date),
          activedate = new Date(new Date(new Date(item.active_date).getTime()+(120*24*2*30*1000)).toISOString().substr(0, 10)),
          datenow =  new Date(new Date().getTime()+(120*24*7*59*1000)).toISOString().substr(0, 10)
          // derived date
        var dateObj = new Date();
        var month = dateObj.getMonth()+1; 
        var day = dateObj.getDate();
        var year = dateObj.getFullYear();
        if(month <10){
          month = '0'+month
        }
        var newdate = year + "-" + month + "-" + day;
        console.log(activedate)
        console.log(newdate)
        if (new Date(datenow) > duedate) return 'trans'
        else if (new Date(newdate) >= activedate) return 'transgreen'
        else return 'none'
        // else return 'green'
      },
      jofActions(item){
        item.jof_status = 'Stone Section'
        item.remarks=0
         axios.post('/api/JOFupdateStatus/',item)
            .then(()=>{
               axios.post('/api/jofhistory',item)
                  .then((response)=>{
                        axios.get('/JOFinit/5')
                        .then((response)=>{
                            this.dataItems = response.data
                        })
                  })
              })
            .catch(error => {
              console.log(error.message);
            })
      },
      close (a) {
        this.dialog = false
        setTimeout(() => {
          this.editedItem = Object.assign({}, this.defaultItem)
          this.editedIndex = -1
        }, 300)
      },
      editItem (item) {
        this.editedIndex = this.dataItems.indexOf(item)
        this.editedItem = Object.assign({}, item)
        this.dialog = true
      },
      save(){
        console.log(this.editedStatus)
        if(this.editedStatus != ''){
          this.editedItem.jof_status = this.editedStatus
          this.editedItem.remarks = 1
          axios.post('/api/JOFupdateStatus/',this.editedItem)
            .then(()=>{
                axios.get('/JOFinit/5')
                  .then((response)=>{
                      this.dataItems = response.data
                  })
              })
            .catch(error => {
              console.log(error.message);
            })
        }
        this.close()
      }
       
    },
   
   
    
  }
</script>