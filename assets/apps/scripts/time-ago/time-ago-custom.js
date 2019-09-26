/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


function iso8601(date) {
    return date.getUTCFullYear()
            + "-" + (date.getUTCMonth() + 1)
            + "-" + date.getUTCDate()
            + "T" + date.getUTCHours()
            + ":" + date.getUTCMinutes()
            + ":" + date.getUTCSeconds() + "Z";
}

function init_index_page() {
    document.querySelector('.load_time').setAttribute('datetime', iso8601(new Date()));
    var timeagoInstance = timeago(null, navigator.language.replace('-', '_'));
    timeagoInstance.render(document.querySelectorAll('.need_to_be_rendered'));

// 2. demo
    document.getElementById('demo_now').innerHTML = timeago().format(new Date());
    document.getElementById('demo_20160907').innerHTML = timeago(null, 'zh_CN').format('2016-09-07');
    document.getElementById('demo_timestamp').innerHTML = timeago().format(1473245023718);
}

init_index_page();