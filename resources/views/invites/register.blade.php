@extends('layouts.master')

@section('content')
<section class="site__container">
    <div class="col-3"><!-- Spacer --></div>

    <div class="col-6">
        <div class="box box--with-margin">
            <span class="box__title">Register New Account</span>
            <div class="box__content">
                <form method="POST" action="{{ route('registerInvitedUser') }}">
                    {{ csrf_field() }}
                    <label for="name">Username</label>
                    <input id="name" type="text" class="form__input" name="name" value="{{ old('name') }}" required autofocus>

                    @if ($errors->has('name'))
                        <div class="alert alert-danger">
                            <strong>{{ $errors->first('name') }}</strong>
                        </div>
                    @endif

                    <label for="email">E-Mail Address</label>
                    <input id="email" type="email" class="form__input" name="email" value="{{ old('email') }}" required>

                    @if ($errors->has('email'))
                        <div class="alert alert-danger">
                            <strong>{{ $errors->first('email') }}</strong>
                        </div>
                    @endif

                    <label for="password">Password</label>
                    <input id="password" type="password" class="form__input" name="password" required>

                    @if ($errors->has('password'))
                        <div class="alert alert-danger">
                            <strong>{{ $errors->first('password') }}</strong>
                        </div>
                    @endif

                    <label for="password-confirm">Confirm Password</label>
                    <input id="password-confirm" type="password" class="form__input" name="password_confirmation" required>

                    <label for="terms">Terms and Conditions</label>
                    <textarea name="terms" id="terms" class="form__input" rows="10" readonly>BASIC NON-DISCLOSURE (NDA) AGREEMENT
This Nondisclosure Agreement (the "Agreement") is entered into by and between GameFront.com and Yourself, for the purpose of preventing the unauthorized disclosure of Confidential Information as defined below. The parties agree to enter into a confidential relationship with respect to the disclosure of certain proprietary and confidential information ("Confidential Information").

1. Definition of Confidential Information. 

For purposes of this Agreement, "Confidential Information" shall include all information or material that has or could have commercial value or other utility in the business in which Disclosing Party is engaged. If Confidential Information is in written form, the Disclosing Party shall label or stamp the materials with the word "Confidential" or some similar warning. If Confidential Information is transmitted orally, the Disclosing Party shall promptly provide a writing indicating that such oral communication constituted Confidential Information.

2. Exclusions from Confidential Information. 

Receiving Party's obligations under this Agreement do not extend to information that is: (a) publicly known at the time of disclosure or subsequently becomes publicly known through no fault of the Receiving Party; (b) discovered or created by the Receiving Party before disclosure by Disclosing Party; (c) learned by the Receiving Party through legitimate means other than from the Disclosing Party or Disclosing Party's representatives; or (d) is disclosed by Receiving Party with Disclosing Party's prior written approval.

3. Obligations of Receiving Party. 

Receiving Party shall hold and maintain the Confidential Information in strictest confidence for the sole and exclusive benefit of the Disclosing Party. Receiving Party shall carefully restrict access to Confidential Information to employees, contractors and third parties as is reasonably required and shall require those persons to sign nondisclosure restrictions at least as protective as those in this Agreement. Receiving Party shall not, without prior written approval of Disclosing Party, use for Receiving Party's own benefit, publish, copy, or otherwise disclose to others, or permit the use by others for their benefit or to the detriment of Disclosing Party, any Confidential Information. Receiving Party shall return to Disclosing Party any and all records, notes, and other written, printed, or tangible materials in its possession pertaining to Confidential Information immediately if Disclosing Party requests it in writing.

4. Time Periods. 

The nondisclosure provisions of this Agreement shall survive the termination of this Agreement and Receiving Party's duty to hold Confidential Information in confidence shall remain in effect until the Confidential Information no longer qualifies as a trade secret or until Disclosing Party sends Receiving Party written notice releasing Receiving Party from this Agreement, whichever occurs first.

5. Relationships. 

Nothing contained in this Agreement shall be deemed to constitute either party a partner, joint venturer or employee of the other party for any purpose.

6. Severability. 

If a court finds any provision of this Agreement invalid or unenforceable, the remainder of this Agreement shall be interpreted so as best to affect the intent of the parties.

7. Integration. 

This Agreement expresses the complete understanding of the parties with respect to the subject matter and supersedes all prior proposals, agreements, representations and understandings. This Agreement may not be amended except in a writing signed by both parties.

8. Waiver. 

The failure to exercise any right provided in this Agreement shall not be a waiver of prior or subsequent rights.

This Agreement and each party's obligations shall be binding on the representatives, assigns and successors of such party. Each party has signed this Agreement through its authorized representative.</textarea>
                    
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" name="terms_accept" id="terms_accept">
                            I accept the above Non Disclosure Agreement and also agree to the <a href="http://www.gamefront.com/terms-of-use">Terms &amp; Conditions</a>.
                        </label>
                    </div>
                    
                    @if ($errors->has('terms_accept'))
                        <div class="alert alert-danger">
                            <strong>{{ $errors->first('terms_accept') }}</strong>
                        </div>
                    @endif

                    @captcha()

                    <button type="submit" class="button blue">
                        Register Account
                    </button>


                </form>
            </div>
        </div>
    </div>

    <div class="col-3"><!-- Spacer --></div>
</section>
@endsection
