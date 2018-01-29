<template>
    <div class="m-l-50 m-t-30 w-500">
        <el-form ref="form" :model="selectData" label-width="150px">
            <el-form-item label="Name">
                <el-input v-model.trim="selectData.name" class="h-40 w-200"></el-input>
            </el-form-item>
            <el-form-item label="Address">
                <el-input v-model.trim="selectData.address" class="h-40 w-200"></el-input>
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
        this.apiPost("admin/department", data).then(res => {
          // _g.clearVuex('setRules')
          if (res.code == 200) {
            _g.toastMsg("success", res.data);
            vm.goback();
          } else {
            _g.toastMsg("error", res.error);
          }
        });
      } else {
        this.apiPost("admin/department/update", data).then(res => {
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