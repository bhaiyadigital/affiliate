<x-meta-info.meta :setup="$setup" type="WebPage" :title="'Create an Account | ' . ($setup->site_name ?? 'Bhaiya Housing')" :description="'Register as an affiliate member at ' .
    ($setup->site_name ?? 'Bhaiya Housing') .
    '. Start referring customers, tracking leads, and earning rewards in real-time.'" :keywords="'register, bhaiya housing affiliate, sign up, referral program, join now'"
    :image="$setup->logo_url ?? asset('images/header/logo.png')" :canonical="url()->current()" :robots="'noindex, nofollow'" :breadcrumb="[
        ['name' => 'Home', 'url' => route('home.index')],
        ['name' => 'Create Account', 'url' => url()->current()],
    ]" />
