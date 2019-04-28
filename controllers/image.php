<?php
class ImageController {
	/**
	* Constructor
	* @param Registry $registry
	* @param int $user the user id
	* @return void
	*/
	public function __construct( $registry, $user ){}
	/**
	*<label for="profile_picture">Photograph</label> <br />
	*<input type="file" id="profile_picture" name="profile_
	*picture" />
	*<br />
	*/
	private function editProfile(){
		if( isset( $_POST['profile_picture'] ) ){
			require_once( FRAMEWORK_PATH . 'lib/images/imagemanager.class.php' );
			$im = new Imagemanager();
			$im->loadFromPost( 'profile_picture', $this->registry->getSetting('uploads_path') .'profile/', time() );
			if( $im == true ){
				$im->resizeScaleHeight( 150 );
				$im->save( $this->registry->getSetting('uploads_path')
				.'profile/' . $im->getName() );
				$profile->setPhoto( $im->getName() );
			}
				//We then save the profile, and redirect the user back to the edit page after informing them that the profile has been saved.
			$profile->save();
			$this->registry->redirectUser( array('profile', 'view','edit' ), 'Profile saved', 'The changes to your profile have been saved', false );
		}
	}

}
?>