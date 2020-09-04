<?php

//
// create the new TTS object
//
$tts = new SwiftTTS();

//
// set a voice to use for generation
//
$tts->setVoice("Allison");

//
// generate text, and return a stream for the audio
//
$s = $tts->generate("hello my name is allison", SwiftTTS::FORMAT_WAV);
if ($s !== false)
{
        //
        // write the stream contents to a file
        //
        file_put_contents("audio.wav", $s);
}


?>