(function () {
  if (!Array.prototype.indexOf) {
    Array.prototype.indexOf = function indexOf(member, startFrom) {
      /*
      In non-strict mode, if the `this` variable is null or undefined, then it is
      set to the window object. Otherwise, `this` is automatically converted to an
      object. In strict mode, if the `this` variable is null or undefined, a
      `TypeError` is thrown.
      */
      if (this == null) {
        throw new TypeError("Array.prototype.indexOf() - can't convert `" + this + "` to object");
      }

      var
        index = isFinite(startFrom) ? Math.floor(startFrom) : 0,
        that = this instanceof Object ? this : new Object(this),
        length = isFinite(that.length) ? Math.floor(that.length) : 0;

      if (index >= length) {
        return -1;
      }

      if (index < 0) {
        index = Math.max(length + index, 0);
      }

      if (member === undefined) {
        /*
          Since `member` is undefined, keys that don't exist will have the same
          value as `member`, and thus do need to be checked.
        */
        do {
          if (index in that && that[index] === undefined) {
            return index;
          }
        } while (++index < length);
      } else {
        do {
          if (that[index] === member) {
            return index;
          }
        } while (++index < length);
      }

      return -1;
    };
  }
  if (!Array.prototype.forEach) {

    Array.prototype.forEach = function (callback, thisArg) {

      var T, k;

      if (this == null) {
        throw new TypeError(' this is null or not defined');
      }

      // 1. Let O be the result of calling toObject() passing the
      // |this| value as the argument.
      var O = Object(this);

      // 2. Let lenValue be the result of calling the Get() internal
      // method of O with the argument "length".
      // 3. Let len be toUint32(lenValue).
      var len = O.length >>> 0;

      // 4. If isCallable(callback) is false, throw a TypeError exception. 
      // See: http://es5.github.com/#x9.11
      if (typeof callback !== "function") {
        throw new TypeError(callback + ' is not a function');
      }

      // 5. If thisArg was supplied, let T be thisArg; else let
      // T be undefined.
      if (arguments.length > 1) {
        T = thisArg;
      }

      // 6. Let k be 0
      k = 0;

      // 7. Repeat, while k < len
      while (k < len) {

        var kValue;

        // a. Let Pk be ToString(k).
        //    This is implicit for LHS operands of the in operator
        // b. Let kPresent be the result of calling the HasProperty
        //    internal method of O with argument Pk.
        //    This step can be combined with c
        // c. If kPresent is true, then
        if (k in O) {

          // i. Let kValue be the result of calling the Get internal
          // method of O with argument Pk.
          kValue = O[k];

          // ii. Call the Call internal method of callback with T as
          // the this value and argument list containing kValue, k, and O.
          callback.call(T, kValue, k, O);
        }
        // d. Increase k by 1.
        k++;
      }
      // 8. return undefined
    };
  }

  function Validator() {
    this.rules = []
    this.ruleFuns = {
      require: function (value, msg) {
        if (!value || value.length === 0) {
          return msg
        }
      }
    }
  }

  Validator.prototype = {
    constructor: Validator,
    addRule: function (el, ruleString, errMsg) {
      el.addEvent('focus', function () {
        el.removeClass('error')
      })
      var _this = this
      this.rules.push(function () {
        var arr = ruleString.split(':')
        var ruleFun = _this.ruleFuns[arr.shift()]
        arr.unshift(el.value)
        arr.push(errMsg) 
        var msg = ruleFun.apply(this, arr)
        if (msg) {
          el.addClass('error')
          return msg
        }
      })
    },
    validate: function () {
      for (var i = 0, fun; fun = this.rules[i++];) {
        var msg = fun();
        if (msg) {
          return msg
        }
      }
    }
  }

  var ele = function (selector, parent) {
    if (!selector) return selector;
    if (typeof selector !== 'string' && selector instanceof Element) {
      return factory(selector)
    }
    var element;
    parent = parent || document;
    if (selector.split('#').length == 2) {
      element = document.getElementById(selector.split('#')[1]);
    } else {
      element = parent.querySelectorAll(selector);
    }

    function factory(el) {
      if (el.isEle) return el;
      el.isEle = true;
      var proto = {
        prototype: Element,
        val: function (value) {
          return typeof value === 'string' ? (this.value = value) : this.value;
        },
        html: function (html) {
          return typeof html === 'string' ? (this.innerHTML = html) : this.innerHTML
        },
        next: function () {
          var nextElement = this.nextSibling;
          while (nextElement instanceof Text) {
            nextElement = nextElement.nextSibling;
          }
          return ele(nextElement);
        },
        addClass: function (klass) {
          classArray = this.className.split(' ');
          classArray.indexOf(klass) == -1 && (this.className += ' ' + klass);
          return this;
        },
        removeClass: function (klass) {
          classArray = this.className.split(' ');
          if (classArray.indexOf(klass) == -1) return;
          classArray.splice(classArray.indexOf(klass), 1);
          this.className = classArray.join(' ');
          return this;
        },
        hasClass: function (klass) {
          classArray = this.className.split(' ');
          return classArray.indexOf(klass) > -1;
        },
        ele: function (selector) {
          return ele(selector, this)
        },
        getInput: function (name) {
          return this.ele('input[name=' + name + ']')[0];
        },
        addEvent: function (type, cb) {
          if (this.addEventListener) {
            this.addEventListener(type, cb);
          } else if (this.attachEvent) {
            this.attachEvent('on' + type, function (e) {
              e = e || window.event;
              e.target = e.target || e.srcElement;
              cb(e);
            });
          }
          return this;
        },
        target: function (type) {
          if (typeof type === "string") {
            if (document.dispatchEvent) {
              var event = document.createEvent('HTMLEvents');
              event.initEvent(type, true, true);
              this.dispatchEvent(event);
            } else if (document.attachEvent) {
              this.fireEvent('on' + type)
            }
          }
          return this;
        },
        // removeSelf
      }
      if (el.__proto__) {
        proto.__proto__ = el.__proto__;
        el.__proto__ = proto;
      } else {
        for (var i in proto) {
          el[i] = proto[i];
        }
      }
      return el;
    }
    if (element instanceof Element) {
      element = factory(element);
    } else if (element) {
      for (var i = 0; i < element.length; i++) {
        factory(element[i]);
      }
      element.call = function (name, arg1, arg2) {
        for (var i = 0; i < element.length; i++) {
          element[i][name](arg1, arg2);
        }
      }
    } else {
      console.log('unknow ele type ', selector)
      return null;
    }

    return element;
  }
  var Helper = function (options) {
    this.modalTimer = null;
    this.vaptchaObj = null;
    this.form = ele(document.body);
    this.options = options || {};
  }
  Helper.prototype = {
    constructor: Helper,
    isPhone: function (phone) {
      return phone.trim().length > 5
      var myreg = /^[1][3,4,5,7,8][0-9]{9}$/;
      if (!myreg.test(phone)) {
        return false;
      } else {
        return true;
      }
    },
    showMsg: function (msg, success) {
      var klass = success ? '.vaptcha-tip-success' : '.vaptcha-tip-warn';
      this.modalTimer && clearTimeout(this.modalTimer);
      box = this.form.ele('.vaptcha-tip-cont')[0];
      box.style.zIndex = "10000"
      modal = this.form.ele(klass)[0];
      modal.removeClass('none');
      box.removeClass('none');
      modal.ele('.dz-tip-text')[0].innerHTML = msg
      this.modalTimer = setTimeout(function () {
        box.addClass('none')
        modal.addClass('none');
      }, 1500)
    },
    getFormData: function (form) {
      var inputs = form.ele('input');
      var res = {}
      for (var i = 0; i < inputs.length; i++) {
        inputs[i].name && (res[inputs[i].name] = inputs[i].value);
      }
      return res;
    },
    stopDefault: function (e) {
      if (e && e.preventDefault) {
        e.stopPropagation();
        e.preventDefault();
      } else {
        e.cancelBubble = true;
        e.returnValue = false;
      }
    },
    ajax: function (options) {
      var url = options.url,
        callback = options.success,
        errorCb = options.error,
        type = options.type || 'GET',
        data = options.data || null,
        xmlHttp;

      function createxmlHttpRequest() {
        if (window.ActiveXObject) {
          xmlHttp = new ActiveXObject("Microsoft.XMLHTTP");
        } else if (window.XMLHttpRequest) {
          xmlHttp = new XMLHttpRequest();
        }
      }

      function postDataFormat(obj) {
        if (typeof obj != "object") {
          return obj;
        }
        if (typeof FormData == "function") {
          var data = new FormData();
          for (var attr in obj) {
            data.append(attr, obj[attr]);
          }
          return data;
        } else {
          var arr = new Array();
          var i = 0;
          for (var attr in obj) {
            arr[i] = encodeURIComponent(attr) + "=" + encodeURIComponent(obj[attr]);
            i++;
          }
          return arr.join("&");
        }
      }
      createxmlHttpRequest();
      xmlHttp.open(type, this.options.site_url + url);
      if (typeof FormData == "undefined") {
        xmlHttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded; charset=UTF-8");
      }
      xmlHttp.send(postDataFormat(data));
      xmlHttp.onreadystatechange = function (result) {
        if ((xmlHttp.readyState === 4)) {
          var data = xmlHttp.responseText
          try {
            data = JSON.parse(data);
          } catch(err) {
            var arr = data.split("'")
            arr.forEach(function (v) {
              /^[\u4e00-\u9fa5]+/g.test(v) && (data = v)
            })
          }
          if (xmlHttp.status === 200 && data.status === 200) {
            callback && callback(data);
          } else {
            errorCb && errorCb(data);
          }
        }
      }
    },
    initVaptcha: function (options) {
      var self = this;
      var form = options.form;
      var successCallback = options.success;
      options.scene = options.scene || '';
      var _v = new function () {
        this.isPass = false;
        this.vaptcha = null;
        this.refresh = function () {
          this.vaptcha.reset()
          // form.querySelector('input[name=vaptcha_challenge]').value = '';
          // form.querySelector('input[name=vaptcha_token]').value = '';
          // if (this.isPass) {
          //   this.vaptcha.destroy();
          //   self.initVaptcha(options);
          // }
        }
      }()
      var init = function () {
        var config = {
          vid: self.options.vid,
          container: options.element,
          type: options.type || 'float',
          style: self.options.vaptcha_style || 'dark',
          https: options.https || false,
          color: self.options.vaptcha_color || '#3c8aff',
          lang: 'zh-CN',
          scene: options.scene,
          // outage: self.options.site_url + '/plugin.php?id=phone_auth&action=offline',
        }
        window.vaptcha(config).then(function (obj) {
          obj.listen('pass', function() {
            _v.isPass = true
            successCallback && successCallback()
          })
          obj.listen('mounted', function () {
            obj.renderTokenInput()
          })
          _v.vaptcha = obj;
          _v.vaptcha.render();
        });
      }
      var script = document.getElementById('vaptcha_v_js');
      if (script && window.vaptcha && script.loaded) {
        init();
      } else {
        script = document.createElement('script');
        protocol = 'https'; //options.https ? 'https' : 'http';
        script.src = protocol + '://cdn.vaptcha.com/v2.js';
        script.id = 'vaptcha_v_js';
        script.async = true
        script.onload = script.onreadystatechange = function () {
          if (!this.readyState || this.readyState == 'loaded' || this.readyState == 'complete') {
            init();
            script.loaded = true;
            script.onload = script.onreadystatechange = null;
          }
        };
        document.getElementsByTagName("head")[0].appendChild(script);
      }
      return _v;
    },
    resetSendCodeBtn: function (sendCodeBtn) {
      this.countDownTimer && clearTimeout(this.countDownTimer);
      sendCodeBtn.innerText = this.options.lang.send_code;
      sendCodeBtn.removeAttribute('disabled');
    },
    buttonCountDown: function (sendCodeBtn, time) {
      var self = this;
      time = time || 120;
      sendCodeBtn.setAttribute('disabled', 'disabled');
      this.countDownTimer && clearTimeout(this.countDownTimer);
      (function countDown() {
        if (time == 0) {
          sendCodeBtn.removeAttribute('disabled');
          sendCodeBtn.innerText = self.options.lang.send_code;
          return;
        }
        sendCodeBtn.innerText = time + 's';
        time--;
        self.countDownTimer = setTimeout(countDown, 1000);
      })()
    },
    passwordLevel: function (oPass, oLevel) {
      oPass.addEvent('keyup', function (e) {
        e = e || window.event;
        var strongRegex = new RegExp("^(?=.{8,})(?=.*[A-Z])(?=.*[a-z])(?=.*[0-9])(?=.*\\W).*$", "g");
        var mediumRegex = new RegExp("^(?=.{7,})(((?=.*[A-Z])(?=.*[a-z]))|((?=.*[A-Z])(?=.*[0-9]))|((?=.*[a-z])(?=.*[0-9]))).*$", "g");
        var enoughRegex = new RegExp("(?=.{6,}).*", "g");
        var allWordsRegex = new RegExp('[a-zA-Z]');
        if (oPass.value.length >= 6) {
          if (strongRegex.test(oPass.value)) {
            oLevel.removeClass('pw-medium');
            oLevel.removeClass('pw-weak');
            oLevel.addClass('pw-strong');
            canBeSubmit = true;
          } else if (mediumRegex.test(oPass.value) || allWordsRegex.test(oPass.value)) {
            oLevel.removeClass('pw-strong');
            oLevel.removeClass('pw-weak');
            oLevel.addClass('pw-medium');
            canBeSubmit = true;
          } else {
            oLevel.removeClass('pw-strong');
            oLevel.removeClass('pw-medium');
            oLevel.addClass('pw-weak');
            canBeSubmit = false;
          }
        } else if (oPass.value.length > 0 && oPass.value.length < 6) {
          oLevel.removeClass('pw-strong');
          oLevel.removeClass('pw-medium');
          oLevel.addClass('pw-weak');
          canBeSubmit = false;
        } else {
          oLevel.removeClass('pw-strong');
          oLevel.removeClass('pw-medium');
          oLevel.removeClass('pw-weak');
          canBeSubmit = false;
        }
        if (e.keyCode == 13) {
          signUp()
        }
      })
    },
    setTitle: function (content) {
      var discuzId = this.form.parentNode.id.split('_').pop();
      var title = ele('#returnmessage_' + discuzId);
      title && trim(title.html()).length != 0 && title.html(content);
    },
    login_run: function (options) {
      var self = this;
      var discuzForm = ele('form[name=login]')[0];
      var wrapper = ele('#loginphone_' + options.id);
      this.form = wrapper;
      discuzForm && discuzForm.parentNode.removeChild(discuzForm);
      var loginLoaded = false;
      var smsLoginLoaded = false;
      var lostpasswordLoaded = false;
      var resetPasswordLoaded = false;
      var loginVaptcha;
      var lostpwdVaptcha;

      function loginAction() {
        var form = wrapper.ele('.v-login-form')[0];
        var vaptchaContainer = form.ele('.vaptcha_container');
        var inputs = form.ele('input');
        self.setTitle(options.lang.login_member);
        if (loginLoaded) {
          // inputs.call('val', '');
          return;
        }
        loginLoaded = true;
        var validate = function () {
          var data = self.getFormData(form);
          data.user.length > 0 && form.getInput('user').removeClass('error');
          data.password.length > 5 && form.getInput('password').removeClass('error');
          if (data.user.length > 0 && data.password.length > 5) {
            form.ele('.login-button')[0].removeAttribute('disabled');
          } else {
            form.ele('.login-button')[0].setAttribute('disabled', 'disabled');
          }
        }
        options.login_captcha && (loginVaptcha = self.initVaptcha({
          scene: '01',
          element: vaptchaContainer,
          form: form,
          success: validate
        }))
        inputs.call('addEvent', 'keyup', validate)
        inputs.call('addEvent', 'blur', validate)
        if (options.code_login) {
          form.ele('.sms-login-tab')[0].addEvent('click', function (e) {
            form.addClass('none');
            ele('.v-sms-login-form')[0].removeClass('none');
            smsLoginAction();
          })
        }
        form.ele('.login-button')[0].addEvent('click', function (e) {
          self.ajax({
            url: '/plugin.php?id=phone_auth&mod=logging&action=login&loginsubmit=yes',
            type: 'POST',
            data: self.getFormData(form),
            success: function (data) {
              window.location.href = window.location.href
            },
            error: function (data) {
              if (['user', 'password', 'vaptcha'].indexOf(data.error_pos) >= 0) {
                form.getInput(data.error_pos) && form.getInput(data.error_pos).addClass('error');
                data.msg && self.showMsg(data.msg);
              }
              if (data.error_pos === 'location_activation') {
                return window.location.href = data.msg;
              }
              /* if (data.error_pos == 'bind_phone') {
                wrapper.ele('.bind-phone-form')[0].ele('.user-name')[0].html(data.msg);
                bindPhoneAction();
                return;
              } */
              data.msg && self.showMsg(data.msg);
              options.login_captcha && loginVaptcha.refresh();
              form.ele('.login-button')[0].setAttribute('disabled', 'disabled');
            }
          })
        })
      }

      function smsLoginAction() {
        var form = wrapper.ele('.v-sms-login-form')[0];
        var vaptchaContainer = form.ele('.vaptcha_container');
        var sendCodeBtn = form.ele('.dz-btn-code')[0];
        var inputs = form.ele('input');
        var loginBtn = form.ele('.login-button')[0];
        if (smsLoginLoaded) {
          return;
        }
        var validate = function () {
          var data = self.getFormData(form);
          if (self.isPhone(data.phone) && /^\d{6}$/.test(data.code)) {
            loginBtn.removeAttribute('disabled');
          } else {
            loginBtn.setAttribute('disabled', 'disabled');
          }
        }
        form.getInput('phone').addEvent('keyup', function (e) {
          var it = e.target;
          !Number(it.value) && (it.value = parseInt(it.value) ? parseInt(it.value) : '');
          self.resetSendCodeBtn(sendCodeBtn)
        })
        inputs.call('addEvent', 'focus', function (e) {
          var it = e.target;
          it.removeClass('error');
        })
        inputs.call('addEvent', 'keyup', validate);
        inputs.call('addEvent', 'focus', validate);
        smsLoginLoaded = true;
        var _captcha = self.initVaptcha({
          scene: '01',
          element: vaptchaContainer,
          form: form,
          success: function () {
            sendCodeBtn.click();
            form.ele('.send-code-group')[0].removeClass('none');
          }
        })
        var isSending = false;
        sendCodeBtn.addEvent('click', function () {
          if (isSending) return;
          if (!self.isPhone(form.getInput('phone').value)) {
            form.getInput('phone').addClass('error');
            return;
          }
          isSending = true;
          self.ajax({
            url: '/plugin.php?id=phone_auth&action=sendlogincode',
            type: 'POST',
            data: {
              'phone': form.getInput('phone').value,
              'vaptcha_token': form.getInput('vaptcha_token').value
            },
            success: function (data) {
              isSending = false;
              self.showMsg(data.msg, true);
              isSend = true;
              sendCodeBtn.setAttribute('disabled', 'disabled');
              self.buttonCountDown(sendCodeBtn, 120);
            },
            error: function (data) {
              isSending = false;
              if (data.error_pos === 'vaptcha') {
                _captcha.refresh();
              }
              if (data.error_pos === 'phone') {
                form.getInput('phone').addClass('error')
              }
              if (data.status === 301) {
                self.buttonCountDown(sendCodeBtn, data.msg);
              } else {
                self.showMsg(data.msg);
              }
            }
          })
        })
        loginBtn.addEvent('click', function (e) {
          self.ajax({
            url: '/plugin.php?id=phone_auth&mod=logging&action=smslogin&loginsubmit=yes',
            type: 'POST',
            data: self.getFormData(form),
            success: function (data) {
              window.location.reload();
            },
            error: function (data) {
              if (['user', 'password', 'vaptcha'].indexOf(data.error_pos) >= 0) {
                form.getInput(data.error_pos) && form.getInput(data.error_pos).addClass('error');
                data.msg && self.showMsg(data.msg);
              }
              data.msg && self.showMsg(data.msg);
              form.ele('.login-button')[0].setAttribute('disabled', 'disabled');
            }
          })
        })
        form.ele('.login-tab')[0].addEvent('click', function (e) {
          form.addClass('none');
          ele('.v-login-form')[0].removeClass('none');
        })
      }

      function lostpasswordAction() {
        var form = wrapper.ele('.lost-password-form')[0];
        var vaptchaContainer = form.ele('.vaptcha_container');
        var emailForm = form.ele('.find-password-email')[0]
        var inputs = form.ele('input');
        var sendCodeBtn = form.ele('.dz-btn-code')[0];
        if (emailForm) {
          // 切换找回方式
          var emailValidator = new Validator()
          emailValidator.addRule(emailForm.getInput('email'), 'require', '邮箱不能为空')
          emailValidator.addRule(emailForm.getInput('username'), 'require', '用户名不能为空');
          // emailValidator.addRule(emailForm.getInput('vaptcha_token'), 'require', '请进行人机验证');
          ['email', 'phone'].forEach(function (k) {
            form.ele('.' + k + '-tab')[0].addEvent('click', function () {
              Array.prototype.forEach.call(form.ele('.find-panel'), function (el) {
                el.style.display = 'none'
              })
              Array.prototype.forEach.call(form.ele('.dz-tab'), function (el) {
                el.removeClass('active')
              })
              form.ele('.' + k + '-tab')[0].addClass('active')
              form.ele('.find-password-' + k)[0].style.display = 'block'
            })
          })

          emailVaptcha = self.initVaptcha({
            element: emailForm.ele('.vaptcha_container'),
            form: emailForm,
            success: function () {}
          });

          form.ele('.send-email')[0].addEvent('click', function () {
            var msg = emailValidator.validate()
            if (msg) return self.showMsg(msg)
            var iframe = document.createElement('iframe')
            iframe.id = 'postiframe'
            iframe.name = 'postiframe'
            iframe.style.display = 'none'
            event.target.setAttribute('disabled', 'disabeled')
            document.body.appendChild(iframe)
            var f = document.getElementById('lostpwform')
            iframe.onload = function () {
              var s = ''
              try {
                s = iframe.contentWindow.document.XMLDocument.text;
              } catch (e) {
                try {
                  s = iframe.contentWindow.document.documentElement.firstChild.wholeText;
                } catch (e) {
                  try {
                    s = iframe.contentWindow.document.documentElement.firstChild.nodeValue;
                  } catch (e) {
                    s = '内部错误，无法显示此内容';
                  }
                }
                event.target.removeAttribute('disabled')
              }
              var arr = s.split("'")
              arr.forEach(function (v) {
                /^[\u4e00-\u9fa5]+/g.test(v) && (s = v)
              })
              self.showMsg(s)
              iframe.parentNode.removeChild(iframe)
            }
            f.submit();
            return false;
          })
        }

        self.setTitle(options.lang.password_reset);
        if (lostpasswordLoaded) {
          inputs.call('val', '');
          this.countDownTimer && clearTimeout(this.countDownTimer);
          form.getInput('phone').removeAttribute('disabled');
          form.ele('button').call('setAttribute', 'disabled', 'disabled');
          sendCodeBtn.removeAttribute('disabled');
          sendCodeBtn.html(options.lang.send_code);
          form.ele('.pw-strength')[0].className = 'pw-strength';
          lostpwdVaptcha.refresh();
          return;
        }
        lostpasswordLoaded = true;
        lostpwdVaptcha = self.initVaptcha({
          element: vaptchaContainer,
          form: form,
          success: function () {
            validate();
            sendCodeBtn.click();
            form.ele('.send-code-group')[0].removeClass('none');
          }
        });
        var isSend = false;
        var validate = function () {
          self.isPhone(form.getInput('phone').value) && form.getInput('phone').removeClass('error');
          /^\d{6}$/.test(form.getInput('code').value) && form.getInput('code').removeClass('error');
          if (self.isPhone(form.getInput('phone').value) && /^\d{6}$/.test(form.getInput('code').value)) {
            form.ele('.next-step')[0].removeAttribute('disabled');
          } else {
            form.ele('.next-step')[0].setAttribute('disabled', 'disabled');
          }
        }
        inputs.call('addEvent', 'keyup', validate)
        form.ele('.next-step')[0].addEvent('click', function () {
          self.ajax({
            url: '/plugin.php?id=phone_auth&action=verifyCode',
            type: 'POST',
            data: {
              'phone': form.getInput('phone').value,
              'code': form.getInput('code').value
            },
            success: function (data) {
              form.addClass('none');
              ele('.reset-password')[0].removeClass('none');
              resetPasswordAction();
            },
            error: function (data) {
              form.ele('.next-step')[0].setAttribute('disabled', 'disabled');
              if (data.error_pos == 'phone') {
                form.getInput('phone').addClass('error');
              }
              if (data.error_pos == 'code') {
                form.getInput('code').addClass('error');
              }
              self.showMsg(data.msg);
            }
          })
        })
        form.getInput('phone').addEvent('keydown', function () {
          self.resetSendCodeBtn(sendCodeBtn)
        })
        var isSending = false;
        sendCodeBtn.addEvent('click', function () {
          if (isSending) return;
          validate();
          isSending = true;
          self.ajax({
            url: '/plugin.php?id=phone_auth&action=sendcode',
            type: 'POST',
            data: {
              'phone': form.getInput('phone').value,
              'vaptcha_token': form.getInput('vaptcha_token').value,
            },
            success: function (data) {
              isSending = false;
              self.showMsg(data.msg, true);
              isSend = true;
              sendCodeBtn.setAttribute('disabled', 'disabled');
              self.buttonCountDown(sendCodeBtn, 120);
            },
            error: function (data) {
              isSending = false;
              if (data.error_pos === 'vaptcha') {
                lostpwdVaptcha.refresh();
              }
              if (data.error_pos === 'phone') {
                form.getInput('phone').addClass('error')
              }
              if (data.status === 301) {
                isSend = true;
                self.buttonCountDown(sendCodeBtn, data.msg);
              } else {
                self.showMsg(data.msg);
              }
            }
          })
        })

      }

      function resetPasswordAction() {
        var form = wrapper.ele('.reset-password')[0];
        var inputs = form.ele('input');
        var oPass = form.getInput('new_password');
        self.setTitle(options.lang.password_reset);
        if (resetPasswordLoaded) {
          inputs.call('val', '');
          form.ele('button').call('setAttribute', 'disabled', 'disabled');
        }
        resetPasswordLoaded = true;
        self.passwordLevel(form.getInput('new_password'), form.ele('.pw-strength')[0]);
        inputs.call('addEvent', 'keyup', function () {
          if (form.getInput('new_password').value.length == form.getInput('verify_password').value.length &&
            form.getInput('new_password').value.length > 5 && form.getInput('new_password').value.length < 21) {
            form.ele('.submit-btn')[0].removeAttribute('disabled');
          } else {
            form.ele('.submit-btn')[0].setAttribute('disabled', 'disabled');
          }
        })
        form.ele('.submit-btn')[0].addEvent('click', function () {
          self.ajax({
            url: '/plugin.php?id=phone_auth&action=resetPassword',
            type: 'POST',
            data: {
              'new_password': form.getInput('new_password').value
            },
            success: function (data) {
              self.showMsg(data.msg, true);
              setTimeout(function () {
                wrapper.ele('.vaptcha-dz-popup').call('addClass', 'none')
                wrapper.ele('.v-login-form')[0].removeClass('none');
                loginAction();
              }, 1000)
            },
            error: function (data) {
              self.showMsg(data.msg);
            }
          })
        })
      }

      function bindPhoneAction() {
        var form = wrapper.ele('.bind-phone-form')[0];
        wrapper.ele('.vaptcha-dz-popup').call('addClass', 'none')
        form.removeClass('none');
        var sendCodeBtn = form.ele('.dz-btn-code')[0];
        self.setTitle(options.lang.bind_phone);
        var validate = function () {
          if (!self.isPhone(form.getInput('phone').value)) {
            form.getInput('phone').addClass('error');
            return;
          } else {
            form.getInput('phone').removeClass('error');
            (_vaptcha.isPass && form.getInput('code').value.length === 6) ?
            form.ele('.bind-phone-btn')[0].removeAttribute('disabled'):
              form.ele('.bind-phone-btn')[0].setAttribute('disabled', 'disabled');
          }
        }
        if (options.enable_inter) {
          self.initCountryCode(form);
          form.getInput('country_code').addEvent('keyup', function (e) {
            var it = e.target;
            !Number(it.value) && (it.value = parseInt(it.value) ? parseInt(it.value) : '');
          })
        }
        var _vaptcha = self.initVaptcha({
          element: form.ele('.vaptcha_container')[0],
          form: form,
          success: function () {
            sendCodeBtn.target('click');
            form.ele('.send-code-group')[0].removeClass('none');
          }
        });
        form.ele('input').call('addEvent', 'blur', validate);
        form.ele('input').call('addEvent', 'focus', function (e) {
          e.target.removeClass('error');
        });
        form.getInput('code').addEvent('blur', function (e) {
          e.target.target('keyup')
        })
        form.getInput('code').addEvent('keyup', function (e) {
          validate();
          it = e.target;
          if (it.value.length !== 6) {
            it.addClass('error');
          } else {
            it.removeClass('error');
          }
        })
        form.getInput('phone').addEvent('keydown', function () {
          self.resetSendCodeBtn(sendCodeBtn)
        })
        var isSending = false;
        sendCodeBtn.addEvent('click', function (e) {
          self.stopDefault(e);
          if (isSending) return;
          isSending = true;
          self.ajax({
            url: '/plugin.php?id=phone_auth&action=bindPhoneCode',
            type: 'POST',
            data: self.getFormData(form),
            success: function (data) {
              isSending = false;
              self.showMsg(data.msg, true);
              sendCodeBtn.setAttribute('disabled', 'disabled');
              self.buttonCountDown(sendCodeBtn, 120);
            },
            error: function (data) {
              isSending = false;
              if (data.error_pos === 'vaptcha') {
                _vaptcha.refresh();
              }
              if (data.error_pos === 'phone') {
                form.getInput('phone').addClass('error')
              }
              if (data.status === 301) {
                self.buttonCountDown(sendCodeBtn, data.msg);
              } else {
                self.showMsg(data.msg);
              }
            }
          })
        })
        form.ele('.bind-phone-btn')[0].addEvent('click', function (e) {
          self.ajax({
            url: '/plugin.php?id=phone_auth&action=bindPhone',
            type: 'POST',
            data: self.getFormData(form),
            success: function (data) {
              if (data.status === 200) {
                window.location.reload();
              }
            },
            error: function (data) {
              if (data.error_pos === 'phone') {
                form.getInput('phone').addClass('error');
              }
              if (data.error_pos === 'vaptcha') {
                _vaptcha.refresh();
              }
              form.ele('.bind-phone-btn')[0].setAttribute('disabled', 'disabled');
              self.showMsg(data.msg);
            }
          })
          self.stopDefault(e);
        })
      }
      var showLostPasswordView = function () {
        wrapper.ele('.vaptcha-dz-popup').call('addClass', 'none')
        wrapper.ele('.lost-password-form')[0].removeClass('none');
        lostpasswordAction();
      }
      // smsLoginAction(); return ;
      ele('.lost-password')[0] && ele('.lost-password')[0].addEvent('click', showLostPasswordView)
      if (options.islostpwd) {
        showLostPasswordView();
      } else if (options.bind_phone) {
        bindPhoneAction();
      } else {
        loginAction();
      }
    },
    initCountryCode: function (form) {
      var menu = form.ele('.dropdown-menu')[0];
      var btn = form.ele('.btn-down')[0];
      var show = function () {
        menu.style.display = 'block';
        btn.addClass('open');
      }
      var hide = function () {
        menu.style.display = 'none';
        btn.removeClass('open');
      }
      form.getInput('country_code').addEvent('focus', show)
      btn.addEvent('click', function () {
        menu.style.display = menu.style.display == 'block' ? hide() : show();
      })
      ele('body')[0].addEvent('click', function (e) {
        var elem = e.target;
        !form.ele('.dropdown')[0].contains(elem) && hide()
      })
      menu.ele('.dropdown-item').call('addEvent', 'click', function (e) {
        hide();
        form.getInput('country_code').value = e.target.innerHTML.split('+')[1].trim();
      })
    },
    register_run: function (options) {
      var self = this;
      var discuzForm = ele('#registerform');
      var form = ele('#registerphone_' + options.id);
      this.form = form;
      var inputsValidate = {
        username: false,
        email: options.has_email == 0,
        password: false,
        phone: false,
        vaptcha: false,
        code: false,
        qq: options.has_qq == 0,
        agreebbrule: true
      }
      discuzForm.html('');
      //form input rule validate
      var sendCodeBtn = ele('.dz-btn-code')[0];

      function formValidate() {
        var isTrue = inputsValidate.username && inputsValidate.email && inputsValidate.password && inputsValidate.phone;
        (isTrue && inputsValidate.code && inputsValidate.agreebbrule) ?
        ele('#register_btn').removeAttribute('disabled'): ele('#register_btn').setAttribute('disabled', 'disabled');
        return isTrue;
      }
      if (options.enable_inter) {
        this.initCountryCode(form);
        form.getInput('country_code').addEvent('keyup', function (e) {
          var it = e.target;
          !Number(it.value) && (it.value = parseInt(it.value) ? parseInt(it.value) : '');
          inputsValidate.phone = self.isPhone(it.value);
        })
      }
      form.ele('input').call('addEvent', 'focus', function (e) {
        var it = e.target;
        it.removeClass('error')
        it.next() && it.next().removeClass('error');
      })
      form.getInput(options.username).addEvent('focus', function (e) {
        e.target.next().html(options.lang.username);
      })
      form.getInput(options.username).addEvent('keyup', function (e) {
        var it = e.target;
        it.value = trim(it.value);
        inputsValidate.username = (it.value.length < 3 || it.value.length > 15) ? false : true;
      })
      form.getInput(options.username).addEvent('blur', function (e) {
        var it = e.target;
        it.target('keyup');
        inputsValidate.username = inputsValidate.username && !/^\d+$/.test(it.value)
        if (!inputsValidate.username) {
          inputsValidate.username = false;
          it.addClass('error')
          it.next().addClass('error')
        }
      })
      if (options.has_email == 1) {
        form.getInput(options.email).addEvent('focus', function (e) {
          e.target.next().html(options.lang.email);
        })
        form.getInput(options.email).addEvent('keyup', function (e) {
          var it = e.target;
          it.value = trim(it.value);
          inputsValidate.email = /^(\w)+(\.\w+)*@(\w)+((\.\w{2,3}){1,3})$/.test(it.value);
        })
        form.getInput(options.email).addEvent('blur', function (e) {
          var it = e.target;
          it.target('keyup');
          if (!inputsValidate.email) {
            it.addClass('error');
            it.next().addClass('error');
            it.next().html(options.lang.email_error);
          }
        })
      }
      if (options.has_qq) {
        form.getInput('qq').addEvent('focus', function (e) {
          e.target.next().html('');
        })
        form.getInput('qq').addEvent('keyup', function (e) {
          var it = e.target;
          it.value = trim(it.value);
          it.value && (inputsValidate.qq = true);
        })
        form.getInput('qq').addEvent('blur', function (e) {
          var it = e.target;
          it.target('keyup');
          if (!inputsValidate.qq) {
            it.addClass('error');
            it.next().addClass('error');
            it.next().html(options.lang.qq_error);
          }
        })
      }
      self.passwordLevel(form.getInput(options.password), form.ele('.pw-strength')[0]);
      form.getInput(options.password).addEvent('blur', function (e) {
        var it = e.target;
        if (it.value.length < 6 || it.value.length > 20) {
          inputsValidate.password = false;
          it.addClass('error');
          it.next().addClass('error');
        } else {
          inputsValidate.password = true;
        }
      })
      form.getInput('phone').addEvent('focus', function (e) {
        e.target.next().html('');
      })
      form.getInput('phone').addEvent('keyup', function (e) {
        var it = e.target;
        !Number(it.value) && (it.value = parseInt(it.value) ? parseInt(it.value) : '');
        inputsValidate.phone = self.isPhone(it.value);
        self.resetSendCodeBtn(sendCodeBtn)
      })

      form.getInput('phone').addEvent('blur', function (e) {
        var it = e.target;
        it.target('keyup');
        if (!inputsValidate.phone) {
          it.addClass('error');
          it.next().addClass('error');
          it.next().html(options.lang.phone);
        }
      })
      form.getInput('code').addEvent('keyup', function (e) {
        var it = e.target;
        it.value = trim(it.value);
        inputsValidate.code = /^\d{6}$/.test(it.value)
      })
      form.getInput('code').addEvent('blur', function (e) {
        var it = e.target;
        it.target('keyup');
        !inputsValidate.code && it.addClass('error');
      })
      if (options.has_bbrules === 1) {
        function showBBRule() {
          showDialog($('layer_bbrule').innerHTML, 'info', '');
          $('fwin_dialog_close').style.display = 'none';
        }
        form.ele('.protocal-link')[0].addEvent('click', showBBRule)
        var bbruleValidate = function () {
          inputsValidate.agreebbrule = ele('#agreebbrule').checked;
          formValidate();
        }
        ele('#agreebbrule').addEvent('click', bbruleValidate);
        ele('#agreebbrule').next().addEvent('click', bbruleValidate);
      }
      form.ele('input').call('addEvent', 'keyup', formValidate);
      var isSending = false;
      sendCodeBtn.addEvent('click', function () {
        form.getInput('phone').target('blur');
        if (!inputsValidate.phone || isSending) {
          return false;
        }
        isSending = true;
        self.ajax({
          url: '/plugin.php?id=phone_auth&action=sendRegisterCode',
          type: 'POST',
          data: {
            'phone': form.getInput('phone').value,
            'country_code': form.getInput('country_code').value.trim(),
            'vaptcha_token': form.getInput('vaptcha_token').value
          },
          success: function (data) {
            isSending = false;
            sendCodeBtn.setAttribute('disabled', 'disabled');
            self.buttonCountDown(sendCodeBtn, 120);
          },
          error: function (data) {
            isSending = false;
            if (data.error_pos === 'vaptcha') {
              form.ele('.vaptcha_container')[0].next().html(data.msg);
              self.initVaptcha({
                element: form.ele('.vaptcha_container'),
                form: form,
                success: function () {
                  formValidate();
                  form.ele('.vaptcha_container')[0].next().html('');
                  sendCodeBtn.target('click');
                }
              })
            } else if (['phone', 'code'].indexOf(data.error_pos) >= 0) {
              form.getInput(data.error_pos).addClass('error')
              form.getInput(data.error_pos).next().addClass('error')
              form.getInput(data.error_pos).next().html(data.msg);
            } else if (data.status === 301) {
              self.buttonCountDown(sendCodeBtn, data.msg);
            } else {
              self.showMsg(data.msg);
            }
          }
        })
      })
      ele('#register_btn').addEvent('click', function () {
        self.ajax({
          url: '/plugin.php?id=phone_auth&action=register',
          data: self.getFormData(form),
          type: 'POST',
          success: function (data) {
            if (data.status === 200) {
              document.referrer ? (window.location.href = document.referrer) : 
              window.location.reload()
            }
          },
          error: function (data) {
            var username = form.getInput(options.username);
            var email = form.getInput(options.email);
            if (['username', 'email', 'invitecode'].indexOf(data.error_pos) > -1) {
              form.getInput(data.error_pos).addClass('error');
              form.getInput(data.error_pos).next().addClass('error');
              form.getInput(data.error_pos).next().html(data.msg);
            } else {
              data.msg && self.showMsg(data.msg);
            }
          }
        })
      })
      self.initVaptcha({
        element: form.ele('.vaptcha_container'),
        form: form,
        type: 'popup',
        success: function () {
          inputsValidate.vaptcha = true;
          form.ele('.dz-code-group')[0].removeClass('none');
          form.ele('.vaptcha_container')[0].next().html('');
          sendCodeBtn.target('click');
          formValidate();
        }
      })
    },
    popup_captcha: function (form, container) {
      var self = this;
      container = container || ele('#popup_vaptcha');
      container.ele('.vp-header')[0].style.marginTop = ((window.innerHeight || document.documentElement.clientHeight) -
        230) / 2 + 'px';
      container.style.display = 'block';
      container.ele('.vp-mask')[0].addEvent('click', function (e) {
        container.style.display = 'none';
      });

      function loadVaptcha() {
        var vp = self.initVaptcha({
          scene: '01',
          element: container.ele('.vp-content'),
          type: 'embed',
          form: form,
          success: function login() {
            container['is_pass'] = true;
            var data = self.getFormData(form)
            data.vaptcha_token = vp.vaptcha.getToken()
            self.ajax({
              url: '/plugin.php?id=phone_auth&mod=logging&action=login&loginsubmit=yes',
              type: 'POST',
              data: data,
              success: function (data) {
                window.location.reload();
              },
              error: function (data) {
                container.style.display = 'none';
                if (data.error_pos == 'bind_phone') {
                  return showWindow('login', 'member.php?mod=logging&action=login');
                }
                if (data.error_pos == 'location_activation') {
                  return window.location.href = data.msg;
                }
                data.msg && errorhandle_ls(data.msg, {
                  'loginperm': '4'
                })
              }
            })
          }
        })
        container['is_pass'] = false;
      }
      if (typeof container['is_pass'] == 'undefined' || container['is_pass']) {
        container.ele('.vp-content')[0].html('<div class="loading"><span style="animation-delay: -.32s"></span><span style="animation-delay: -.16s"></span><span></span></div>');
        loadVaptcha();
      }
    },
    login_simple_run: function (options) {
      var self = this;
      var discuzForm = ele('#lsform').ele('.fastlg')[0]
      var oldForm = discuzForm.ele('.pns')[0];
      var form = discuzForm.ele('.v-login-simple')[0];
      discuzForm.replaceChild(form, oldForm);
      form.ele('.login-btn')[0].addEvent('click', function (e) {
        self.stopDefault(e);
        var user = form.getInput('user');
        var password = form.getInput('password');
        if (user.val() && password.val()) {
          options.login_captcha ? self.popup_captcha(form) :
            self.ajax({
              url: '/plugin.php?id=phone_auth&mod=logging&action=login&loginsubmit=yes',
              type: 'POST',
              data: self.getFormData(form),
              success: function (data) {
                window.location.reload();
              },
              error: function (data) {
                console.log(data);
                if (data.error_pos == 'bind_phone') {
                  return showWindow('login', 'member.php?mod=logging&action=login');
                }
                data.msg && errorhandle_ls(data.msg, {
                  'loginperm': '4'
                })
              }
            });
        } else {
          showWindow('login', 'member.php?mod=logging&action=login');
        }
      })
      // self.popup_captcha(form)
    },
    activation: function () {
      var form = ele('#registerform'),
        submitBtn = form.ele('#registerformsubmit'),
        self = this;
      submitBtn.addEvent('click', function (e) {
        e.preventDefault();
        self.ajax({
          type: 'POST',
          url: '/plugin.php?id=phone_auth&action=activation',
          data: self.getFormData(form),
          success: function () {
            window.location.reload();
          },
          error: function (data) {
            errorhandle_ls(data.msg, '');
          }
        });
      })
    }
  }
  window.v_helper = Helper;
  window.ele = ele;
})()