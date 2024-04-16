DELIMITER //

CREATE PROCEDURE GetNumberOfTracksByArtist(
    IN artistName VARCHAR(32),
    OUT numberOfTracks INT
)
BEGIN
    SELECT COUNT(*)
    INTO numberOfTracks
    FROM artist_tracks at
    JOIN artists a ON at.artist_id = a.artist_id
    JOIN tracks t ON at.track_id = t.track_id
    WHERE a.artist_name = artistName;
END //

DELIMITER ;
