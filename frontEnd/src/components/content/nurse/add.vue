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
            <el-form-item label="title">
                <el-input v-model.trim="selectData.title" class="h-40 w-200"></el-input>
            </el-form-item>
            <el-form-item label="Department">
                <!-- <el-input v-model.trim="selectData.type" class="h-40 w-200"></el-input> -->
                <el-select class="w-200"  v-model="selectData.department" placeholder="">
                        <el-option
                          v-for="item in departmentList"
                          :key="item.Id"
                          :label="item.name"
                          :value="item.name">
                        </el-option>
                      </el-select>
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
      sexList: [
        {
          value: "man",
          label: "man"
        },
        {
          value: "women",
          label: "women"
        }
      ],
      departmentList: [],
      isLoading: false
    };
  },
  methods: {
    goback() {
      this.$emit("goback", false);
    },
    addData() {
      this.isLoading = !this.isLoading;
      const data = {
        user_id:this.selectData.user_id,
        sex: this.selectData.sex,
        age: this.selectData.age,
        title: this.selectData.title,
        department: this.selectData.department
      };
      console.log(data)
      let vm = this
      if (this.add) {
        this.apiPost("admin/nurse", data).then(res => {
          // _g.clearVuex('setRules')
          if ((res.code = 200)) {
             _g.toastMsg("success", res.data);
            vm.goback();
          } else {
            _g.toastMsg("error", res[1]);
          }
          this.isLoading = false;
        });
      } else {
        this.apiPost("admin/nurse/update", data).then(res => {
          // _g.clearVuex('setRules')
          if (res.code = 200) {
             _g.toastMsg("success", res.data);
            vm.goback();
          } else {
            _g.toastMsg("error", res[1]);
          }
          this.isLoading = false;
        });
      }
    }
  },
  props: ["add", "selectData"],
  created() {
    let vm = this;
    const data = {
      params: {}
    };
    this.apiGet("admin/department", data).then(res => {
      if (res.code == 200) {
        for (let department of res.data.list) {
          let obj = {
            Id: department.Id,
            name: department.name,
            address: department.address
          };
          vm.departmentList.push(obj);
        }
      }
    });
  },
  mounted() {},
  computed: {},
  components: {},
  mixins: [http]
};
</script>