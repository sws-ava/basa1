<template>
  <div class="main catalog">
    <div class="container">
      <div class="row">
        <div class="col12">
          <ul>
            <li>
              <!-- <router-link to="/badges">Badges</router-link> -->
            </li>
            <li></li>
          </ul>
        </div>
      </div>
    </div>
    <div class="container">
      <div class="row">
        <div class="col-12">
          <div
            class="searchBlockHolder"
            style="background-image: url(/images/bg_search.jpg)"
          >
            <div class="searchBlock">
              <div class="title">Поиск по базе</div>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-12 col-lg-6 mb-4">
          <div class="pageTitle">Каталог компаний</div>
        </div>
        <div class="col-12 col-lg-6 mb-4 text-right">
          <div class="sortType">
            Сортировка:
            <select class="brandSelect sortTypeSelect" name="sortType" id="">
              <option value="1">По рейтингу</option>
              <option value="1">По рейтингу</option>
            </select>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-12 mb-4">
          <div id="catalog">
            <div v-for="company in companies" class="catalogItem">
              <div class="row">
                <div class="col-12 col-lg-6">
                  <div class="stars">
                    <img src="/images/star.svg" alt="" />
                    <img src="/images/star.svg" alt="" />
                    <img src="/images/star.svg" alt="" />
                    <img src="/images/starEmpty.svg" alt="" />
                    <img src="/images/starEmpty.svg" alt="" />
                  </div>
                  <div class="title">{{ company.name }}</div>
                  <div class="geo">
                    {{ company.districtName }} <br />
                    {{ company.cityName }}
                  </div>
                </div>
                <div class="col-12 col-lg-3">
                  <div class="info">
                    <div class="infoBlock">
                      <span>Телефон</span>
                      <a <!-- href="tel:{{ company.phone }}">
                        -->

                        {{ company.phone }}
                      </a>
                    </div>
                    <div class="infoBlock">
                      <span>Руководитель</span> Евсина Наталья Юрьевна
                    </div>
                  </div>
                </div>
                <div class="col-12 col-lg-3">
                  <div class="info">
                    <div class="infoBlock">
                      <span>Почта</span>
                      <!-- <a href:mailto:{{company.email}}>{{ company.email }}</a> -->
                    </div>
                    <div class="infoBlock">
                      <span>Сайт</span>
                      <!-- <a target="_blank" href:{{company.site}}>{{ company.site }}</a> -->
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "Catalog",
  data() {
    return {
      companies: [],
    };
  },
  mounted() {
    axios.get("/getCompanies").then((result) => {
      console.log(result);
      this.companies = result.data;
    });
  },
};
</script>

<style>
</style>
