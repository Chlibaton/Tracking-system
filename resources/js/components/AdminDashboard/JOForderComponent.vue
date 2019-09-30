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
.not_special{
   background-color: #e0e0e000 !important;
}
.bg-dark {
    color: #ffc107 !important;
}
</style>


<template>
<div>
      <v-toolbar flat color="white">
        <v-toolbar-title>JOF Order</v-toolbar-title>
        <v-divider class="mx-4" inset vertical></v-divider>
        <v-text-field v-model="search" append-icon="search" label="Search" single-line hide-details></v-text-field>
      <v-spacer></v-spacer>
      <!-- ADD JOF MODAL -->
        <v-dialog v-model="dialog" max-width="1250px">
          <template v-slot:activator="{ on }">
            <v-btn color="primary" dark class="mb-2" v-on="on">Create New JOF</v-btn>

          </template>
          <v-form ref="form" v-model="valid" lazy-validation  @submit.prevent>
          <v-card>
            <v-card-title>
              <span class="headline">{{ formTitle }}</span>
            <v-btn color="primary" dark class="mb-2" v-on:click="getSeries()" :disabled="seriesbtn">Generate JOF No.</v-btn>

            </v-card-title>

            <v-card-text>
              <v-container grid-list-md>
                <v-layout wrap>
                    <v-flex xs6>
                   <v-text-field v-model="editedItem.refno" filled readonly label="Reference No" ></v-text-field>
                  </v-flex>
                  <v-flex xs6>
                   <v-text-field v-model="editedItem.jofno" filled readonly label="JOF#" ></v-text-field>
                  </v-flex>
                     <v-flex xs6>
                   <v-text-field v-model="editedItem.orderno" label="Order Name" ></v-text-field>
                  </v-flex>
                   <v-flex xs6>
                     <v-switch v-model="switch1" label="Special Order"></v-switch>
                  </v-flex>
                    <v-flex xs12>
                    <v-text-field v-model="editedItem.distributor_name" label="Distributor Name" ></v-text-field>
                  </v-flex>
                  <v-flex xs12>
                    <v-text-field v-model="editedItem.customer_name" label="Customer Name" ></v-text-field>
                  </v-flex>
                  
                  
                  <v-flex xs6>
                            <v-menu   v-model="menu1" :close-on-content-click="false" min-width="290px" offset-y >
                              <template v-slot:activator="{ on }">
                                <v-text-field clearable prepend-icon="event" readonly label="Date Prepared" v-on="on"  :value="date1"></v-text-field>
                              </template>
                              <v-date-picker v-model="date1">
                              </v-date-picker>
                            </v-menu>
                  </v-flex>
                  <v-flex xs6>
                    <!-- <v-text-field v-model="editedItem.due_date" label="Due Date"></v-text-field> -->
                            <v-menu v-model="menu2"  :close-on-content-click="false" max-width="290" offset-y >
                              <template v-slot:activator="{ on }">
                                <v-text-field clearable prepend-icon="event" readonly label="Due Date" v-on="on"  :value="date2"></v-text-field>
                              </template>
                              <v-date-picker v-model="date2" >
                              </v-date-picker>
                            </v-menu>
                  </v-flex>
                    <v-spacer></v-spacer>
                  <!-- ring details -->
                <v-flex xs12>
                     <v-card>
                       <v-card-title>Ring Details</v-card-title>
                        <v-card-text>
                        <v-flex xs6>
                            <v-text-field v-model="editedItem.kind_of_ring" label="Kind Of Ring"></v-text-field>
                        </v-flex>
                         <v-layout wrap>
                        <v-flex xs6>
                            <v-text-field v-model="editedItem.metal" label="Metal"></v-text-field>
                        </v-flex>
                        <v-flex xs6>
                            <v-text-field v-model="editedItem.stone" label="Stone"></v-text-field>
                        </v-flex>
                         <v-flex xs6>
                            <v-text-field v-model="editedItem.ring_size" label="Ring Size"></v-text-field>
                        </v-flex>
                        <v-flex xs6>
                            <!-- <v-text-field v-model="editedItem.bridge" label="Bridge"></v-text-field> -->
                        </v-flex>
                         <v-flex xs6>
                            <v-text-field v-model="editedItem.year" label="Year"></v-text-field>
                        </v-flex>
                        <v-flex xs6>
                            <v-text-field v-model="editedItem.weight" label="Weight"></v-text-field>
                        </v-flex>
                          <v-flex xs6>
                            <v-text-field v-model="editedItem.karat" label="Karat"></v-text-field>
                        </v-flex>
                        <v-flex xs6>
                            <v-text-field v-model="editedItem.oxidation" label="Oxidation"></v-text-field>
                        </v-flex>
                        <v-flex xs6>
                            <v-text-field v-model="editedItem.text_style" label="Text Style"></v-text-field>
                        </v-flex>
                        <v-flex xs6>
                            <v-text-field v-model="editedItem.inside_engrave" label="Inside Engrave"></v-text-field>
                        </v-flex>
                         <!-- <v-flex xs6>
                            <v-text-field v-model="editedItem.quantity" label="Quantity"></v-text-field>
                        </v-flex> -->
                            </v-layout>
                        </v-card-text>
                    </v-card>
                  </v-flex>
                  <!-- Shank -->
                   <v-flex xs12>
                     <v-card>
                       <v-card-title>Shank Design</v-card-title>
                        <v-card-text>
                            <v-layout wrap>
                         <v-flex xs12>
                            <v-textarea v-model="editedItem.left_shank"  label="Left Shank"  hint="Add Left Shank"></v-textarea>
                        </v-flex>
                         <v-flex xs12>
                            <v-textarea v-model="editedItem.top_shank" label="Top Shank"  hint="Add Top Shank"></v-textarea>
                        </v-flex>
                        <v-flex xs12>
                            <v-textarea v-model="editedItem.right_shank" label="Right Shank"  hint="Add Right Shank"></v-textarea>
                        </v-flex>
                            </v-layout>
                        </v-card-text>
                    </v-card>
                  </v-flex>
                  <!-- Attachment of Images -->
                     <v-flex xs12>
                     <v-card>
                       <v-card-title>Attach Artwork</v-card-title>
                        <v-card-text>
                            <v-layout wrap>
                         <v-flex xs12>
                            <v-label>Upload Photo</v-label>
                            <input type="file" @change="uploadImage" accept="image/*">
                        </v-flex>
                            </v-layout>
                        </v-card-text>
                    </v-card>
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
           <template v-slot:item.jofno="{ item }" > 
            <v-chip v-if="item.sp_order==1" class="bg-dark" > {{ item.jofno }}</v-chip> 
            <v-chip v-else class="not_special"> {{ item.jofno }}</v-chip> 
          </template>
           <template v-slot:item.due_date="{ item }" > 
            <v-chip :class="getColor(item.due_date)" > {{ item.due_date }}</v-chip> 
          </template>
          <template v-slot:item.sp_approve="{ item }" > 
            <div v-if="item.sp_order==1">
            <v-chip v-if="item.sp_approve==0" class="not_special">Pending</v-chip> 
            <v-chip v-else-if="item.sp_approve==2" class="bg-danger">Declined</v-chip> 
            </div>
          </template>
        <template v-slot:item.action="{ item }">
          <v-icon small class="mr-2" @click="editItem(item)" > edit </v-icon>
          <v-icon small  @click="deleteItem(item)" > delete </v-icon>
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
      switch1:false,
      headers: [
        { text: 'JOF#', value: 'jofno',  },
        { text: 'Distributor Name', value: 'distributor_name',  },
        { text: 'Customer Name', value: 'customer_name',  },
        { text: 'Date Prepared', value: 'date_prepared',  },
        { text: 'Due Date', value: 'due_date',  },
        { text: 'Kind of Ring', value: 'kind_of_ring',  },
        { text: 'JOF Status', value: 'jof_status', },
        { text: 'Special Order', value: 'sp_approve', },
        { text: 'Actions', value: 'action', sortable: false },
      ],
      ruleRequired: [
        v => !!v || 'Field is required',
      ],
      dataItems:[],
      addedItems:{},
      editedIndex: -1,
      editedItem: {
          jofno:'',
          refno:''
      },
      activeuser:{},
      numberseries:{},
      seriesbtn:false,
      defaultItem: {
        jofno:'',
        refno:''
      },
      toBeUpdated:{},
      mask: '################',
      date1:new Date().toISOString().substr(0, 10),
      date2:new Date().toISOString().substr(0, 10),
      // date2:new Date(new Date().getTime()+(120*24*60*60*1000)).toISOString().substr(0, 10),
    }),
    
    computed: {
      formTitle () {
        return this.editedIndex === -1 ? 'Create JOF Order' : 'Edit JOF Order'
      },
    },

    watch: {
      dialog (val) {
        val || this.close()
      },
    },

    async mounted(){
        axios.get('/JOFinit/1')
        .then((response)=>{
            this.dataItems = response.data
        })
        axios.get('/getUser')
        .then((response)=>{
           this.activeuser = response.data
            this.editedItem.active_user =this.activeuser.id
            this.defaultItem.active_user =this.activeuser.id
        })
    },
//methods

    methods: {
      editItem (item) {
          this.editedIndex = this.dataItems.indexOf(item)
          this.editedItem = Object.assign({}, item)
          this.dialog = true
       
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
        this.editedItem.created_by = this.activeuser.first_name+' '+ this.activeuser.last_name
        this.editedItem.sp_approve = 0
        if(this.switch1){
          this.editedItem.sp_order = 1
        }else{
          this.editedItem.sp_order = 0
        }
        if(this.$refs.form.validate()){
            // UPDATE/SAVE JOF
            this.editedItem.date_prepared = this.date1
            this.editedItem.due_date = this.date2
            this.editedItem.jof_status ='Receiving Section'
            if (this.editedIndex > -1) {
                this.toBeUpdated = this.dataItems[this.editedIndex]
                axios.put('/api/JOFupdate',this.editedItem)
                .then(()=>{  
                    axios.get('/JOFinit/1')
                        .then((response)=>{
                            this.dataItems = response.data
                        })
                    })
                .catch(function (error) {
                    console.log(error);
                })
            } else {
                this.addedItems = this.editedItem
                axios.post('/api/JOFcreate',this.editedItem)
                    .then(()=>{
                    axios.get('/JOFinit/1')
                        .then((response)=>{
                            this.dataItems = response.data
                        })
                    })
                    this.defaultItem.jofno=''
                    this.defaultItem.refno=''
                    this.seriesbtn=false
                }
            this.close()
        }
      },
       getColor (a) {
          var duedate = new Date(a),
            datenow =  new Date(new Date().getTime()+(120*24*8*31*1000)).toISOString().substr(0, 10)

        if (new Date(datenow) > duedate) return 'trans'
        else return 'none'
        // else return 'green'
      },
     async getSeries(){
        axios.get('api/getSeries')
        .then((response)=>{
            this.numberseries=response.data[0]
           var incrementSeries=parseInt(response.data[0].seriesno)+response.data[0].incrementno,
            year =(response.data[0].series_code)+new Date().getFullYear(),
           seriesno = year+('00000'+incrementSeries).slice(-5);
            this.numberseries.seriesno = seriesno
           this.editedItem.jofno = seriesno
           this.editedItem.refno = 'REF#'+seriesno
            this.editedItem.newseries =seriesno

            this.defaultItem.jofno = seriesno
            this.defaultItem.refno = 'REF#'+seriesno
            this.defaultItem.newseries =seriesno

            this.seriesbtn = true
        })
      },
      //Upload Image
      uploadImage(){
      var input = event.target;
      if (input.files && input.files[0]) {
          var reader = new FileReader();
          reader.onload = (e) => {
              this.editedItem.upload_image = e.target.result;
          }
          reader.readAsDataURL(input.files[0]);
      }
      },
       
    },

   
   
    
  }
</script>