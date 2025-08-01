'use strict';

// drower   
document.addEventListener('DOMContentLoaded', function () {
  const wrapper = document.getElementById('wrapper');
  const openNav = document.getElementById('open_nav'); 
  const nav = document.getElementById('nav');
  const closeNav = document.getElementById('batu');

  openNav.addEventListener('click', function () {
    nav.classList.add('show');
    nav.classList.remove('show_reverse');
    wrapper.classList.add('show');
  });

  closeNav.addEventListener('click', function () {
    nav.classList.remove('show');
    nav.classList.add('show_reverse');
    wrapper.classList.remove('show');
  });

  wrapper.addEventListener('click', function () {
    nav.classList.remove('show');
    nav.classList.add('show_reverse');
    wrapper.classList.remove('show');
  });

  window.addEventListener('scroll', function () {
    if (nav.classList.contains('show')) {
      nav.classList.remove('show');
      nav.classList.add('show_reverse');
      wrapper.classList.remove('show');
    }
  });
});

// アコーディオン
// ▼「検索条件」ボタンを押すと、選択肢（お値段／系統）が出る
document.getElementById('openCondition').addEventListener('click', function () {
    const menu = document.getElementById('conditionMenu');
    const btn = document.getElementById('openCondition'); 
    menu.style.display = (menu.style.display === 'block') ? 'none' : 'block';

    btn.classList.toggle('open');

    // 折りたたんだときは詳細も消す
    if (menu.style.display === 'none') {
        document.getElementById('priceMenu').style.display = 'none';
        document.getElementById('typeMenu').style.display = 'none';
    }
});

// 「お値段」か「ドーナツ系統」を選んだら、それに対応する select を表示
function showDetail(type) {
    document.getElementById('priceMenu').style.display = 'none';
    document.getElementById('typeMenu').style.display = 'none';

    if (type === 'price') {
        document.getElementById('priceMenu').style.display = 'block';
    } else if (type === 'type') {
        document.getElementById('typeMenu').style.display = 'block';
    }
}


