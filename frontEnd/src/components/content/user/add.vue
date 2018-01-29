<template>
    <div class="m-l-50 m-t-30 w-500">
        <el-form ref="form" :model="selectData" label-width="150px">
            <el-form-item label="Name">
                <el-input v-model.trim="selectData.name" class="h-40 w-200"></el-input>
            </el-form-item>
            <el-form-item label="Password">
                <el-input v-model.trim="selectData.password" class="h-40 w-200"></el-input>
            </el-form-item>
            <el-form-item label="Tel">
                <el-input v-model.trim="selectData.tel" class="h-40 w-200"></el-input>
            </el-form-item>
            <el-form-item label="Type">
                <!-- <el-input v-model.trim="selectData.type" class="h-40 w-200"></el-input> -->
                <el-select class="w-200"  v-model="selectData.type" placeholder="">
                        <el-option
                          v-for="item in userType"
                          :key="item.value"
                          :label="item.label"
                          :value="item.value">
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
import http from "../../../assets/js/http";
// import fomrMixin from '../../../../assets/js/form_com'

export default {
  data() {
    return {
      userType: [
        {
          value: "doctor",
          label: "Doctor"
        },
        {
          value: "nurse",
          label: "Nurse"
        },
        {
          value: "patient",
          label: "Patient"
        },
      ],
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
        this.apiPost("admin/user", data).then(res => {
          // _g.clearVuex('setRules')
          if (res.code == 200) {
            _g.toastMsg("success", res.data);
            vm.goback();
          } else {
            _g.toastMsg("error", res.error);
          }
        });
      } else {
        this.apiPost("admin/user/update", data).then(res => {
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
    console.log("userAdd");
  },
  props: ["add", "selectData"],
  mounted() {},
  computed: {},
  components: {},
  mixins: [http]
};
</script>