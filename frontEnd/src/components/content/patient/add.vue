<template>
    <div class="m-l-50 m-t-30 w-500">
        <el-form ref="form" :model="selectData" label-width="150px">
            <el-form-item label="Name">
                <el-input :disabled="true" v-model.trim="selectData.name" class="h-40 w-200"></el-input>
            </el-form-item>
            <el-form-item label="sex">
                <el-select class="w-200"  v-model="selectData.sex" placeholder="">
                        <el-option
                          v-for="item in sexList"
                          :key="item.value"
                          :label="item.label"
                          :value="item.value">
                        </el-option>
                      </el-select>
            </el-form-item>
            <el-form-item label="age">
                <el-input v-model.trim="selectData.age" class="h-40 w-200"></el-input>
            </el-form-item>
            <!-- <el-form-item label="title">
                <el-input v-model.trim="selectData.title" class="h-40 w-200"></el-input>
            </el-form-item> -->
            <!-- <el-form-item label="Doctor">
                <el-select class="w-200"  v-model="selectData.doctor" placeholder="">
                        <el-option
                          v-for="item in doctorList"
                          :key="item.Id"
                          :label="item.name"
                          :value="item.name">
                        </el-option>
                      </el-select>
            </el-form-item>
            <el-form-item label="Nurse">
                <el-select class="w-200"  v-model="selectData.nurse" placeholder="">
                        <el-option
                          v-for="item in nurseList"
                          :key="item.Id"
                          :label="item.name"
                          :value="item.name">
                        </el-option>
                      </el-select>
            </el-form-item> -->
            <el-form-item>
                <el-button type="primary" @click="addData()" :loading="isLoading">Save</el-button>
                <el-button @click="goback()">Cancel</el-button>
            </el-form-item>
        </el-form>
    </div>
</template>

<script>
import http from "../../../assets/js/http"
// import fomrMixin from '../../../../assets/js/form_com'

export default {
  data() {
    return {
      sexList:[
        {
          value:'man',
          label:'man'
        },
        {
          value:'women',
          label:'women'
        }
      ],
      // doctorList:[],
      // nurseList:[],
      isLoading: false,
    };
  },
  methods: {
    goback() {
      this.$emit("goback", false);
    },
    addData() {
      this.isLoading = !this.isLoading;
      const data = {
        params: this.selectData
      };

      if (this.add) {
        this.apiPost("admin/doctor", data).then(res => {
          // _g.clearVuex('setRules')
          if (res[0]) {
  
          } else {
            _g.toastMsg("error", res[1]);
          }
          this.isLoading = false;
        });
      } else {
        this.apiPut("device/address.php?action=update", data).then(res => {
          // _g.clearVuex('setRules')
          if (res[0]) {
            
          } else {
            _g.toastMsg("error", res[1]);
          }
          this.isLoading = false;
        });
      }
    },
  },
  props: ["add", "selectData"],
  created() {
    // let vm = this;
    // const doctorData = {
    //   params: {}
    // };
    // this.apiGet("admin/doctor", doctorData).then(res => {
    //   if (res.code == 200) {
    //     for (let doctor of res.data.list) {
    //       let obj = {
    //         Id: doctor.Id,
    //         name: doctor.name,
    //       };
    //       vm.doctorList.push(obj);
    //     }
    //   }
    // });
    // const nurseData = {
    //   params: {}
    // };
    // this.apiGet("admin/nurse", nurseData).then(res => {
    //   if (res.code == 200) {
    //     for (let nurse of res.data.list) {
    //       let obj = {
    //         Id: nurse.Id,
    //         name: nurse.name,
    //       };
    //       vm.nurseList.push(obj);
    //     }
    //   }
    // });
  },
  mounted() {
  },
  computed: {
  },
  components: {},
  mixins: [http]
};
</script>