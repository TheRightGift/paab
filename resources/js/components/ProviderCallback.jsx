import axios from "axios";
import React, { useEffect } from "react";
import ReactDOM from "react-dom/client";

function ProviderCallback() {
    useEffect(() => {
        // Anything in here is fired on component mount.
        axios
            .get(`/api/auth/login/facebook/callback?${this.$route.params.code}`)
            .then((response) => {
                console.log(response)
            });
    }, []);
    return (
        <div className="container">
            <div class="container">
                <div class="articles">
                    <div class="main-container">
                        <div class="preloader-wrapper big active">
                            <div class="spinner-layer spinner-blue">
                                <div class="circle-clipper left">
                                    <div class="circle"></div>
                                </div>
                                <div class="gap-patch">
                                    <div class="circle"></div>
                                </div>
                                <div class="circle-clipper right">
                                    <div class="circle"></div>
                                </div>
                            </div>

                            <div class="spinner-layer spinner-red">
                                <div class="circle-clipper left">
                                    <div class="circle"></div>
                                </div>
                                <div class="gap-patch">
                                    <div class="circle"></div>
                                </div>
                                <div class="circle-clipper right">
                                    <div class="circle"></div>
                                </div>
                            </div>

                            <div class="spinner-layer spinner-yellow">
                                <div class="circle-clipper left">
                                    <div class="circle"></div>
                                </div>
                                <div class="gap-patch">
                                    <div class="circle"></div>
                                </div>
                                <div class="circle-clipper right">
                                    <div class="circle"></div>
                                </div>
                            </div>

                            <div class="spinner-layer spinner-green">
                                <div class="circle-clipper left">
                                    <div class="circle"></div>
                                </div>
                                <div class="gap-patch">
                                    <div class="circle"></div>
                                </div>
                                <div class="circle-clipper right">
                                    <div class="circle"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    );
}

export default ProviderCallback;

if (document.getElementById("providerCallback")) {
    const Index = ReactDOM.createRoot(
        document.getElementById("providerCallback")
    );

    Index.render(
        <React.StrictMode>
            <ProviderCallback />
        </React.StrictMode>
    );
}
