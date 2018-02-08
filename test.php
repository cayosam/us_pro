<div id="contact_form">
    <h2 style="font-weight:bold; margin:20px 0; font-size:20px;">お問い合わせフォームDEMO</h2>
    <form method="post" name="demo_form">
        <div class="input_item">
            <dl class="clearfix">
                <dt><span class="req">必須</span>名前</dt>
                <dd>
                    <input type="text" id="name" name="name">
                    <span id="name_error" class="error_m"></span>
                </dd>
            </dl>
 
            <dl class="clearfix">
                <dt><span class="req">必須</span>フリガナ</dt>
                <dd>
                    <input type="text" id="furigana" name="furigana">
                    <span id="furigana_error" class="error_m"></span>
                </dd>
            </dl>
 
            <dl class="clearfix">
                <dt><span class="any">任意</span>ユーザー名</dt>
                <dd>
                    <input type="text" id="username" name="username">
                    <span id="username_error" class="error_m"></span>
                </dd>
            </dl>
 
            <dl class="clearfix">
                <dt><span class="req">必須</span>メールアドレス<br>（半角英数字）</dt>
                <dd>
                    <input type="text" id="mailaddress" name="mail_address">
                    <span id="mailaddress_error" class="error_m"></span>
                    <p class="mail_caution">※記入されたメールアドレス宛に、自動返信で確認メールが届きます。確認メールが届かない場合は、メールアドレスを確認のうえ再度お問い合わせください。</p>
                </dd>
            </dl>
 
            <dl class="clearfix">
                <dt><span class="req">必須</span>電話番号（半角数字）</dt>
                <dd>
                    <input type="tel" id="tel" name="tel">
                    <span id="tel_error" class="error_m"></span>
                </dd>
            </dl>
 
            <dl class="clearfix">
                <dt><span class="req">必須</span>備考・お問い合わせ<br>（500文字以内）</dt>
                <dd>
                    <textarea name="remarks" id="remarks" rows="4" cols="50" maxlength="500" style="overflow: hidden; word-wrap: break-word; resize: horizontal; height: 170px;"></textarea>
                    <span id="remarks_error" class="error_m"></span>
                </dd>
            </dl>
 
            <div class="transmission">
                <input class="btn_submit" id="btn_submit" type="submit" value="内容を送信する" onclick="input_check();return false;">
            </div>
            <p>※デモページなので実際には送信されません</p>
            <div id="send_status"></div>
 
        </div>
    </form>
</div>