<template>
    <div class="m-l-50 m-t-30 w-500">
        <el-form ref="form" :model="selectData" label-width="150px">
            <el-form-item label="doctor">
                <el-input :disabled = "true" v-model.trim="selectData.doctor" class="h-40 w-200"></el-input>
            </el-form-item>
            <el-form-item label="Doctor">
                <el-select class="w-200"  v-model="selectData.doctor" placeholder="">
                        <el-option
                          v-for="item in doctorList"
                          :key="item.Id"
                          :label="item.name"
                          :value="item.Id">
                        </el-option>
                      </el-select>
            </el-form-item>
            <el-form-item label="Nurse">
                <el-select class="w-200"  v-model="selectData.nurse" placeholder="">
                        <el-option
                          v-for="item in nurseList"
                          :key="item.Id"
                          :label="item.name"
                          :value="item.Id">
                        </el-option>
                      </el-select>
            </el-form-item>
            <el-form-item label="Disease">
                <el-select class="w-200"  v-model="selectData.disease" placeholder="">
                        <el-option
                          v-for="item in diseaseList"
                          :key="item.Id"
                          :label="item.name"
                          :value="item.Id">
                        </el-option>
                      </el-select>
            </el-form-item>
            <el-form-item label="Medicine">
                <el-select class="w-200"  v-model="selectData.medicine" placeholder="">
                        <el-option
                          v-for="item in medicineList"
                          :key="item.Id"
                          :label="item.name"
                          :value="item.Id">
                        </el-option>
                      </el-select>
            </el-form-item>
            <el-form-item label="Remark">
                <el-input v-model.trim="selectData.remark" class="h-40 w-200"></el-input>
            </el-form-item>
            <el-form-item>
                <el-button type="primary" @click="addData()" :loading="isLoading">Save</el-button>
                <el-button @click="goback()">Cancel</el-button>
            </el-form-item>
        </el-form>
    </div>
</template>

<script>
import http from "../../../../assets/js/http";
// import fomrMixin from '../../../../assets/js/form_com'

export default {
  data() {
    return {
      doctorList:[],
      nurseList:[],
      diseaseList:[],
      medicineList:[],
      isLoading: false
    };
  },
  methods: {
    goback() {
      this.$emit("goback", false);
    },
    addData() {
      const data = this.selectData;
      let vm = this;
      if (this.add) {
        this.apiPost("admin/record", data).then(res => {
          // _g.clearVuex('setRules')
          if (res.code == 200) {
            _g.toastMsg("success", res.data);
            vm.goback();
          } else {
            _g.toastMsg("error", res.error);
          }
        });
      } else {
        this.apiPost("admin/record/update", data).then(res => {
          // _g.clearVuex('setRules')
          if (res.code == 200) {
            _g.toastMsg("success", res.data);
            vm.goback();
          } else {
            _g.toastMsg("error", res.error);
          }
        });
      }
    }
  },
  created() {
    console.log("doctorTreatAdd");
    let vm = this;
    const doctorData = {
      params: {}
    };
    this.apiGet("admin/doctor", doctorData).then(res => {
      if (res.code == 200) {
        for (let doctor of res.data.list) {
          let obj = {
            Id: doctor.user_id,
            name: doctor.name,
          };
          vm.doctorList.push(obj);
        }
      }
    });
    const nurseData = {
      params: {}
    };
    this.apiGet("admin/nurse", nurseData).then(res => {
      if (res.code == 200) {
        for (let nurse of res.data.list) {
          let obj = {
            Id: nurse.user_id,
            name: nurse.name,
          };
          vm.nurseList.push(obj);
        }
      }
    });
    const diseaseData = {
      params: {}
    };
    this.apiGet("admin/disease", diseaseData).then(res => {
      if (res.code == 200) {
        for (let disease of res.data.list) {
          let obj = {
            Id: disease.Id+"",
            name: disease.name,
          };
          vm.diseaseList.push(obj);
        }
      }
    });
    const medicineData = {
      params: {}
    };
    this.apiGet("admin/medicine", medicineData).then(res => {
      if (res.code == 200) {
        for (let medicine of res.data.list) {
          let obj = {
            Id: medicine.Id+"",
            name: medicine.name,
          };
          vm.medicineList.push(obj);
        }
      }
    });
  },
  props: ["add", "selectData"],
  mounted() {},
  computed: {},
  components: {},
  mixins: [http]
};
</script>