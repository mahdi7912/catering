export default {
    required(message) {
        message = message ? message : "وارد کردن این مورد الزامی است";
        return value => (value !== "" && value !== null) || message;
    },

    max(max) {
        max = max ? max : 15;
        let message = "حداکثر کاراکتر مجاز " + max + "می باشد";
        return value => (value && value.length <= max) || message;
    },

    min(min) {
        min = min ? min : 3;
        let message = "حداقل کاراکتر مجاز " + min + " می باشد ";
        return value => (value && value.length >= min) || message;
    },

    email(message) {
        message = message ? message : "ایمیل وارد شده صحیح نمی باشد.";
        return value => /.+@.+\..+/.test(value) || message;
    },

    between(min = 5, max = 5) {
        let message = "کاراکتر وارد شده باید بین " + min + " و " + max + " باشد ";
        return value =>
            (value && value.length >= min && value.length <= max) || message;
    },

    digits(number = 11, message = "نعداد اعداد وارد شده صحیح نمی باشد") {
        return value => (value && value.length === number) || message;
    },

    phone() {
        let message = "تلفن وارد شده معتبر نمی باشد";
        return this.digits(11, message);
    },

    getValidation(name, args) {
        return this[name](args);
    }
};
